<?php

namespace App\Http\Controllers;

use App\Licencia;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Undefined;
use PharIo\Manifest\License;

/**
 * El archivo LicenciasController gestiona las funciones y peticiones que llegan desde la vista, genera las peticiones y reenvía los datos en caso de ser requeridos así. 
 ***/

class LicenciasController extends Controller
{
    /**
     * La función index nos sirve para gestionar la petición para obtener los datos desde la api "https://practica.hdlatinoamerica.com/api/get" y desde la base de datos relacionada al proyecto.
     */
    public function index(){

        /**
         * Esta primer parte del código representa la llamada a la api para obtener los datos requeridos, con la referencia "id_lic".
         * 
         */

       /* 

        //Se inicializa la variable $id con el valor 2 que representa el id del usuario registrado en la api.
        $id= 2;

        //se define una variable licencias det tipo array para poder guardar las licencias obtenidas desde la api
        $licencias=array();
       
        //Ciclo que se genera para poder guardar cada una de las licencias registradas.
        do{

            // La variable $response guarda la respuesta a la petición a la api, con ayuda del cliente Http que viene por defecto instalado en Laravel. Este cliente con la ayuda de la función withHeaders , recibe las credenciales para poder hacer la autenticación en la api que en este caso es 'token' y 'Authorization' y se llama al método post a la url "https://practica.hdlatinoamerica.com/api/get" y se envía el parámetro requiero "id_lic" con la asignación de la variable $id que en el primer momento el valor es 2. 

            $response = Http::withHeaders([
            'token' => 'token_1K3CETJZOvJi1Tnlbbe7LSYENxV9kBcKJsoRNxmDeS7A8GxyrpYFgHQjsqmM0G2PB933k3QV0XFAB1p2dMr4TNgaai',
            'Authorization' => 'Basic dXNlcl8zODgzMjYwMzQ1MDY0OTA6dXNvZDUzQXJOYWRIVUc3a2s1YmRTcWp2R3phamxv'
            ])->post('https://practica.hdlatinoamerica.com/api/get',[
            "id_lic" => $id
            ]);
            
            
            //una vez obtenida la respuesta, se asignan los valores al array licencias con el valor de la respuesta representada por la variable $response en su atributo 'response' que es donde contiene las datos de cada licencia.

            $licencias[$id] = $response['response'];

            //una vez obtenida la respuesta se incrementa el valor de la variable $id en 1.
            $id+=1;
        }while($id <= 4);*/

        //Todo este ciclo se genera mientras el valor de la variable $id sea menor o igual a 4.
        //Cabe mencionar que aquí encontré un conflicto, puesto que la api no regresaba respuesta con el valor del parámetro "id_lic" en 5, y se volvía a repetir en ciertos valores, es decir el valor de "id_lic" no era un número entero consecutivo, por lo que solo se podía generar esta parte del código hasta el $id con valor 4.


        //Por consiguiente me dispuse a crear la BD y registrar la licencia tanto en el api como en la BD para tener un registro.

        //Con ello la variable $licencias con ayuda del modelo Licencia y el método all() obtiene todos los registros que se encuentren en la BD.
        $licencias = Licencia::all();
    
        //Se hace la llamada a la vista que hará uso de los datos
        return view('licencias.index', compact('licencias'));
    }
    
    //La función create genera el formulario de creación para la licencia.
    public function create(){
        return view('licencias.create');
    }

    /**
     * El método store genera la funcionalidad de enviar a la api los valores recibidos desde el formulario de creación. esta función recibe como parámetro el Request
     */
    public function store(Request $request){

        //La variable $respuesta almacena los datos enviados por el formulario
        $respuesta = $request->all();

        //La variable  $crearLicencia almacena la respuesta de la petición a la api para almacenar una nueva licencia.
        //Con ayuda del cliente Http y la función withHeaders se envían las credenciales para la autenticación y con ayuda del método post a la url " https://practica.hdlatinoamerica.com/api/create" se envían los datos. Los cuales son los siguientes: "id_lic" que es un parámetro requerido y los parámetros "name","vig","prod" que son los que se almacenan en la api y los valores que se envían son los que se obtienen de la variable $respuesta.
        $crearLicencia = Http::withHeaders([
            'token' => 'token_1K3CETJZOvJi1Tnlbbe7LSYENxV9kBcKJsoRNxmDeS7A8GxyrpYFgHQjsqmM0G2PB933k3QV0XFAB1p2dMr4TNgaai',
            'Authorization' => 'Basic dXNlcl8zODgzMjYwMzQ1MDY0OTA6dXNvZDUzQXJOYWRIVUc3a2s1YmRTcWp2R3phamxv'
        ])->post('https://practica.hdlatinoamerica.com/api/create',[
            "id_lic" => 2,
            "name" => $respuesta['name'],
            "vig" => $respuesta['vig'],
            "prod" => $respuesta['prod']
        ]);

        //Como se almaceno también la licencia en la base de datos por las cuestiones que se especificaron antes, la variable $licencia almacena una nueva instacia del modelo Licencia.

       $licencia = new Licencia();

       //Se asignan los valores de cada parámetro requerido en la BD. algunos valores son los que se envían del formulario, pero otros como lo son el parámetro 'code' y el parametro 'status' se almacenan de la respuesta de la llamada al método 'create' de la api
        $licencia->name = $request->input('name');
        $licencia->code = $crearLicencia['response']['code'];
        $licencia->vig = $request->input('vig');
        $licencia->prod = $request->input('prod');
        $licencia->status =$crearLicencia['response']['status'];

        //El método 'save' de la variable $licencia guarda los registros en la base de datos
        $licencia->save();

        //se redireciona a la ruta 'index' del proyecto
        return redirect()->route('index');
    } 
    
    /**
     * La función activar nos ayuda a cambiar el status de la licencia, para activarla en algún caso en específico.
     * 
     * Haciendo las pruebas en la api con la url "https://practica.hdlatinoamerica.com/api/activate" solo requería el id de la licencia para poder activar la licencia, pero al generar las pruebas, el api no realizaba el cambio, solo informaba con el código y el mensaje que todo había sido satisfactoría.
     * 
     * Por lo tanto me dispuse a cambiar los estados de las licencias solo desde la BD 
     */
    public function activar($id){
        /**
         * El código a continuación es el que utilice para hacer la llamada a la api y tratar de actualizar el estado.
         * La variable $id se recibe desde la vista.
         */
        /*$activarLicencia = Http::withHeaders([
            'token' => 'token_1K3CETJZOvJi1Tnlbbe7LSYENxV9kBcKJsoRNxmDeS7A8GxyrpYFgHQjsqmM0G2PB933k3QV0XFAB1p2dMr4TNgaai',
            'Authorization' => 'Basic dXNlcl8zODgzMjYwMzQ1MDY0OTA6dXNvZDUzQXJOYWRIVUc3a2s1YmRTcWp2R3phamxv'
        ])->post('https://practica.hdlatinoamerica.com/api/activate',[
            "id_lic" => $id,
        ]);*/
        //dd($id);


        //Se asigna a la variable $licencia el registro obtenido a partir del $id
        $licencia = Licencia::whereId($id)->first();
        //se cambia el valor del parámetro status
        $licencia->status = 2;
        //se guarda el registro
        $licencia->save();
        
        //se redireciona a la ruta 'index'
        return redirect()->route('index');
    }


    /**
     * La función renovar nos ayuda a cambiar el status de la licencia, para renovarla en algún caso en específico.
     * 
     * Haciendo las pruebas en la api con la url "https://practica.hdlatinoamerica.com/api/renew" solo requería el id de la licencia para poder activar la licencia, pero al generar las pruebas, el api no realizaba el cambio, solo informaba con el código y el mensaje que todo había sido satisfactoría.
     * 
     * Por lo tanto me dispuse a cambiar los estados de las licencias solo desde la BD 
     */
    public function renovar($id){
        //$idLicencia = (int)$id;
        /*$activarLicencia = Http::withHeaders([
            'token' => 'token_1K3CETJZOvJi1Tnlbbe7LSYENxV9kBcKJsoRNxmDeS7A8GxyrpYFgHQjsqmM0G2PB933k3QV0XFAB1p2dMr4TNgaai',
            'Authorization' => 'Basic dXNlcl8zODgzMjYwMzQ1MDY0OTA6dXNvZDUzQXJOYWRIVUc3a2s1YmRTcWp2R3phamxv'
        ])->post('https://practica.hdlatinoamerica.com/api/renew',[
            "id_lic" => $id,
        ]);*/

        //Se asigna a la variable $licencia el registro obtenido a partir del $id
        $licencia = Licencia::whereId($id)->first();
        //se cambia el valor del parámetro status
        $licencia->status = 2;
         //se guarda el registro
        $licencia->save();

        //se redireciona a la ruta 'index'
        return redirect()->route('index');
    }

    /**
     * La función renovar nos ayuda a cambiar el status de la licencia, para desactivar en algún caso en específico.
     * 
     * Haciendo las pruebas en la api con la url "https://practica.hdlatinoamerica.com/api/disabled" solo requería el id de la licencia para poder activar la licencia, pero al generar las pruebas, el api no realizaba el cambio, solo informaba con el código y el mensaje que todo había sido satisfactoría.
     * 
     * Por lo tanto me dispuse a cambiar los estados de las licencias solo desde la BD 
     */
    public function desactivar($id){
        //$idLicencia = (int)$id;
        /*$activarLicencia = Http::withHeaders([
            'token' => 'token_1K3CETJZOvJi1Tnlbbe7LSYENxV9kBcKJsoRNxmDeS7A8GxyrpYFgHQjsqmM0G2PB933k3QV0XFAB1p2dMr4TNgaai',
            'Authorization' => 'Basic dXNlcl8zODgzMjYwMzQ1MDY0OTA6dXNvZDUzQXJOYWRIVUc3a2s1YmRTcWp2R3phamxv'
        ])->post('https://practica.hdlatinoamerica.com/api/disabled',[
            "id_lic" => $id,
        ]);*/

        //Se asigna a la variable $licencia el registro obtenido a partir del $id
        $licencia = Licencia::whereId($id)->first();
        //se cambia el valor del parámetro status
        $licencia->status = 3;
        //se guarda el registro
        $licencia->save();
        //se redireciona a la ruta 'index'
        return redirect()->route('index');
    }
}
