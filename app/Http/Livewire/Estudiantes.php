<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Estudiantes extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $quepasa;
    public $criterio;
    public $_id;
    public $nombres;
    public $direccion;
    public $edad;
    public $accion;
    public $imagen;  
    public $imageName;
    public $newImagen;


    public function agregar() {
        $this->accion = "Agregar";
        $this->limpiarCampos();
        $this->resetErrorBag();
    
    }

    public function edit($id) {
        $this->accion = "Editar";
        $estudiante = Estudiante::find($id);
        $this->limpiarCampos();
        $this->_id = $id;
        $this->nombres = $estudiante->nombres;
        $this->direccion = $estudiante->direccion;
        $this->edad = $estudiante->edad;
    }

    public function update(){
        $estudiante = Estudiante::find($this->_id);
        $estudiante->nombres = $this->nombres;
        $estudiante->direccion = $this->direccion;
        $estudiante->edad = $this->edad;
        $quepasa = "HHHHHH";
        /*
        if( $this->imagen) {
            dd($this->imagen->getClientOriginalName());
            $estudiante->imagen = $this->imagen->getClientOriginalName();            
        } else {
            dd("No viene imagen");
        }
            */
        $estudiante->save();

    }

    public function delete( $id ) {
        $estudiante = Estudiante::find($id);
        $estudiante->delete();
    }

    public function deleteConfirm($id) {
        $this->accion = "Advertencia de eliminación";
        $this->_id = $id;
    }

    public function store(){

        if( $this->accion == "Agregar") {
            $this->validate([
                'nombres' => 'required|max:50|min:8',
                'direccion' => 'required|max:50|min:10',
                'edad' => 'required'
            ]);
            $this->estudiante = New Estudiante();
            $this->estudiante->nombres = $this->nombres;
            $this->estudiante->direccion = $this->direccion;
            $this->$estudiante->edad = $this->edad;

            $this->estudiante->save();
            $this->dispatchBrowserEvent('closeModalestudianteModalAgrega').
            $this->limpiarCampos();
        } else {
            
            if( $this->imagen) {      

                $estudiante = Estudiante::find($this->_id);

                $this->imageName = $this->imagen->getClientOriginalName();
                $this->imagen->storeAs('imagenes',$this->imageName, 'public_upload');
                //$this->imagen->store('imagenes',$this->imageName);

                $estudiante->imagen = $this->imageName;
                
                $estudiante->nombres = $this->nombres;
                $estudiante->direccion = $this->direccion;
                $estudiante->edad = $this->edad;
                $estudiante->save();
                $this->limpiarCampos();
            } else {

                $this->estudiante = Estudiante::find($this->_id);
                $this->estudiante->nombres = $this->nombres;
                $this->estudiante->direccion = $this->direccion;
                $this->estudiante->edad = $this->edad;
                $this->estudiante->save();
                $this->limpiarCampos();
            }
            
        }
    }


    public function limpiarCampos(){
        $this->id = 0;
        $this->nombres = "";
        $this->direccion = "";
        $this->edad = 0;
    }

    public function cerrarModalAgrega(){
        $this->dispatchBrowserEvent('estudianteModalAgrega');
    }


    public function render()
    {
        if( $this->criterio == "" ) {
            $estudiantes = Estudiante::orderBy('id','desc')->paginate(4);
        } else {
            $estudiantes = Estudiante::where('nombres', 'like',"%$this->criterio%")->paginate(4);
        }
        //dd( $estudiantes);
        return view('livewire.estudiantes', compact('estudiantes'));
    }
}
