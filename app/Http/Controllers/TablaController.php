<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class TablaController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sizer(Request $request){
        //obtenemos datos del formulario de welcome
        $decisiones = $request->a_size;
        $estados = $request->e_size;
        
        /*return view('tabla',compact($text));//si funca*/
        return view('tabla',['estados'=>$estados,'decisiones'=>$decisiones]);
        

    }

    public function procesar(Request $request)
    {
        //obtenemos los datos del formulario de tabla
        $e_size= $request->estados;
        $a_size= $request->decisiones;
        
        $tabla=array();
        $tabla[0][0]=floatval($request->x_11);
        $tabla[0][1]=floatval($request->x_12);
        $tabla[0][2]=floatval($request->x_13);
        $tabla[0][3]=floatval($request->x_14);
        $tabla[0][4]=floatval($request->x_15);
        $tabla[1][0]=floatval($request->x_21);
        $tabla[1][1]=floatval($request->x_22);
        $tabla[1][2]=floatval($request->x_23);
        $tabla[1][3]=floatval($request->x_24);
        $tabla[1][4]=floatval($request->x_25);
        $tabla[2][0]=floatval($request->x_31);
        $tabla[2][1]=floatval($request->x_32);
        $tabla[2][2]=floatval($request->x_33);
        $tabla[2][3]=floatval($request->x_34);
        $tabla[2][4]=floatval($request->x_35);
        $tabla[3][0]=floatval($request->x_41);
        $tabla[3][1]=floatval($request->x_42);
        $tabla[3][2]=floatval($request->x_43);
        $tabla[3][3]=floatval($request->x_44);
        $tabla[3][4]=floatval($request->x_45);
        $tabla[4][0]=floatval($request->x_51);
        $tabla[4][1]=floatval($request->x_52);
        $tabla[4][2]=floatval($request->x_53);
        $tabla[4][3]=floatval($request->x_54);
        $tabla[4][4]=floatval($request->x_55);
            
        $probabilidades=array();
        $probabilidades[0]=floatval($request->p1);
        $probabilidades[1]=floatval($request->p2);
        $probabilidades[2]=floatval($request->p3);
        $probabilidades[3]=floatval($request->p4);
        $probabilidades[4]=floatval($request->p5);
        
        $criterio= $request->criterio;
        $k= $request->k;
        $b= $request->b;
        $rtemp= $request->r;
        //------------------------------------------
        //prevenimos divisiones entre 0
        $r=$rtemp==0?1:$rtemp;
        
        //fijamos la constante de euler en 2.718 por comodidad
        $euler=2.718;

        //Recortamos la tabla
        $tmp_final=array();
        for ($i=0; $i < $a_size; $i++) { 
            $tmp_final[$i]=array_slice($tabla[$i],0,$e_size,true);
        }
        $tabla=$tmp_final;
        //recortamos las probalilidades
        $probabilidades=array_slice($probabilidades,0,$e_size,true);
	$check=0;
	for($j=0; $j <$e_size;$j++)
		$check+=$probabilidades[$j];
    $check=round($check,2); //se redondea porque hay decimales que no puedes ser representados en fraccion HUMM!!!
	if($check!=1)
            return "las probabilidades suman :".$check;
        //------------------------------------------
        //E[R(a)]=sum(j)->{x_ij*p_j}
        //------------------------------------------
        $ERa=array();
        for ($i=0; $i < $a_size; $i++) { 
            $ERa[$i]=0;
            for ($j=0; $j < $e_size; $j++)
                $ERa[$i]+=$tabla[$i][$j]*$probabilidades[$j];
            $ERa[$i]=round($ERa[$i],3);
        }

        //V(Ra)=sum(j)->{[(x_ij-ERa_i)^2]*p_j}
        $VRa=array();
        for ($i=0; $i < $a_size; $i++) { 
            $VRa[$i]=0;
            for ($j=0; $j < $e_size; $j++)
                $VRa[$i]+=(pow($tabla[$i][$j]-$ERa[$i],2)*$probabilidades[$j]);    
            $VRa[$i]=round($VRa[$i],3);
        }

        //EC[R(a)]=sum->{E[R(a)]-k√V[R(a)]}
        $EC=array();
        for ($i=0; $i < $a_size; $i++) 
            $EC[$i]=round($ERa[$i]-($k*sqrt($VRa[$i])),2);

        //Pmax[R(a)]=sum(j)->{k>=x_ij?p_j:0;}
        $Pmax=array();
        for ($i=0; $i < $a_size; $i++) { 
            $Pmax[$i]=0;
            for ($j=0; $j < $e_size; $j++)
                $Pmax[$i]+=(($tabla[$i][$j]>=$k?$probabilidades[$j]:0));    
            $Pmax[$i]=round($Pmax[$i],2);
        }

        //U= 1-e^(-x/r)
        $matrizU=array();
        for ($i=0; $i < $a_size; $i++) { 
            for ($j=0; $j < $e_size; $j++)
                $matrizU[$i][$j]=round(1-pow($euler,(-1*($tabla[$i][$j]/$r))),2);    
        }
        
        ///E[R(u)]=sum(j)->{U_ij*p_j}
        $ERu=array();
        $ERu=array();
        for ($i=0; $i < $a_size; $i++) { 
            $ERu[$i]=0;
            for ($j=0; $j < $e_size; $j++)
                $ERu[$i]+=$matrizU[$i][$j]*$probabilidades[$j];
            $ERu[$i]=round($ERu[$i],2);
        }

        //A=max(a_i)-min(a_i)
        $A=array();
        for ($i=0; $i < $a_size; $i++) { 
            $A[$i]=max($tabla[$i])-min($tabla[$i]);
        }

        //E[R(a)]+(β*E[R(a)])-(1-β)*A
        $MARI=array();
        for ($i=0; $i < $a_size; $i++) { 
            $MARI[$i]=round($ERa[$i]+($b*$ERa[$i])-(1-$b)*$A[$i],2);
        }


        $headers=array();
        $datos=array();
        $resultado='holi :3';
        $headers[0]='Decision/Estado';
        for ($i=1; $i <= $e_size ; $i++) { 
            $headers[$i]='e<sub>'.$i.'</sub>';
        }
        switch($criterio){
            default:{
                //no selecciono nada, redirige a home + en caso de cosas raras
                $resultado='NO SELECCIONO UN CRITERIO<meta http-equiv="refresh" content="5; url=/" />';
                $datos=array();
                $headers=array();
            }
            break;
            case 1:{
                //Criterio de Valor esperado
                //Tomamos la decision
                $temp=(array_search(max($ERa),$ERa)+1);
                //Plasmamos el resultado
                $resultado=
                    'Criterio de Valor esperado.<br>R: a<sub>'.$temp.'</sub>';
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('E[R(a)]'));
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(array('a<sub>'.($i+1).'</sub>'),$tabla[$i],array($ERa[$i]));
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 2:{
                //Criterio de minima varianza con media acotada
                //Tomamos la decision
                $temp=0;
                for ($i=0; $i < $a_size; $i++) { 
                    if($ERa[$i]>=$k)
                        if(($temp==0)||($VRa[$i]<=$temp))
                            $temp=$VRa[$i];
                }
                $temp=array_search($temp,$VRa)+1;
                //Plasmamos el resultado
                $resultado=
                    'Criterio de minima varianza con media acotada.<br>R: a<sub>'.$temp
                    .'</sub> con k='.$k;
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('V[R(a)]','E[R(a)]'));
                for ($i=0; $i <$a_size ; $i++) 
                    $datos[$i]=array_merge(array('a<sub>'.($i+1).'</sub>'),$tabla[$i],array($VRa[$i],$ERa[$i]));
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 3:{
                //Criterio de media con varianza acotada
                //Tomamos la decision
                $temp=0;
                for ($i=0; $i < $a_size; $i++) { 
                    if($VRa[$i]<=$k)
                        if(($temp==0)||($ERa[$i]>=$temp))
                            $temp=$ERa[$i];
                }
                $temp=array_search($temp,$ERa)+1;
                //Plasmamos el resultado
                $resultado=
                    'Criterio de media con varianza acotada.<br>R: a<sub>'.$temp
                    .'</sub> con k='.$k;
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('V[R(a)]','E[R(a)]'));
                for ($i=0; $i <$a_size ; $i++) 
                    $datos[$i]=array_merge(
                        array('a<sub>'.($i+1).'</sub>'),
                        $tabla[$i],
                        array($VRa[$i],$ERa[$i]));
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 4:{
                //Criterio de dispersion
                //Tomamos la decision
                $temp=(array_search(max($EC),$EC)+1);
                //Plasmamos el resultado
                $resultado=
                    'Criterio de dispersion.<br>R: a<sub>'.$temp
                    .'</sub> con k='.$k;
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('EC[R(a)]','V[R(a)]','E[R(a)]'));
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(
                            array('a<sub>'.($i+1).'</sub>'),
                            $tabla[$i],
                            array($EC[$i], $VRa[$i], $ERa[$i]));
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 5:{
                //Criterio de probabilidad maxima
                //Tomamos la decision
                $temp=(array_search(max($Pmax),$Pmax)+1);
                //Plasmamos el resultado
                $resultado=
                    'Criterio de probabilidad maxima.<br>R: a<sub>'.$temp
                    .'</sub> con k='.$k;
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('Pmax'));
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(
                            array('a<sub>'.($i+1).'</sub>'),
                            $tabla[$i],
                            array($Pmax[$i]));
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 6:{
                //Criterio de verosimilitud
                //Tomamos la decision
                $temp='ERROR';
                $maxVal=null;
                for ($j=0; $j < $e_size; $j++){
                    if($probabilidades[$j]==max($probabilidades)){
                        for ($i=0; $i < $a_size; $i++){
                            if(($maxVal==null)||($tabla[$i][$j]>=$maxVal)){
                                $maxVal=$tabla[$i][$j];
                                $temp=$i+1;
                            }
                        }
                    }
                }
                //Plasmamos el resultado
                $resultado=
                    'Criterio de verosimilitud.<br>R: a<sub>'.$temp
                    .'</sub> con una probabilidad de '.(max($probabilidades))
                    .'<br>y un valor de '.$maxVal;
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers);
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(
                            array('a<sub>'.($i+1).'</sub>'),
                            $tabla[$i]);
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;
            case 7:{
                //Criterio de utilidad
                //Tomamos la decision
                $temp='ERROR';
                $temp=(array_search(max($ERu),$ERu)+1);
                
                //Plasmamos el resultado
                $resultado=
                    'Criterio de utilidad.<br>R: a<sub>'.$temp
                    .'<br>y un valor de '.(max($ERu));
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('','Tabla U'),array_slice($headers,1,$e_size),array('E[R(u)]'));
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(
                            array('a<sub>'.($i+1).'</sub>'),
                            $tabla[$i],
                            array(''),
                            array('a<sub>'.($i+1).'</sub>'),
                            $matrizU[$i],
                            array($ERu[$i])
                        );
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades,array('','Prob.'),$probabilidades);
            }
            break;
            case 8:{
                //Criterio de Modelo de Amplitud para Riesgo e Incertidumbre (MARI)
                //Tomamos la decision
                $temp='ERROR';
                $temp=(array_search(max($ERu),$ERu)+1);
                
                //Plasmamos el resultado
                $resultado=
                    'Criterio de Modelo de Amplitud para Riesgo e Incertidumbre (MARI).<br>R: a<sub>'.$temp
                    .' con un valor de '.(max($MARI));
                //Desplegamos la tabla correspondiente
                $headers=array_merge($headers,array('A','E[R(a)]','MARI'));
                for ($i=0; $i <$a_size ; $i++) { 
                        $datos[$i]=array_merge(
                            array('a<sub>'.($i+1).'</sub>'),
                            $tabla[$i],
                            array($A[$i]),
                            array($ERa[$i]),
                            array($MARI[$i])
                        );
                }
                $datos[$a_size]=array_merge(array('Prob.'),$probabilidades);
            }
            break;

        }
        // $datos[0]=array('x<sub>1</sub>','x<sub>2</sub>');
        return view('resultados',['headers'=>$headers,'datos'=>$datos,'resultado'=>$resultado]);      
    }

}
        // $datos=array();
?>
