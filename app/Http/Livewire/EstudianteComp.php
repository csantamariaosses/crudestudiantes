<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Estudiante;
use LiveWire\WithPagination;

class EstudianteComp extends Component
{
    

    public $criterio;
    public $_id;
    public $nombres;
    public $direccion;
    public $edad;
    public $accion;


    public function agregar() {
        $this->accion = "Agregar";
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
            $estudiante = New Estudiante();
            $estudiante->nombres = $this->nombres;
            $estudiante->direccion = $this->direccion;
            $estudiante->edad = $this->edad;

            $estudiante->save();
            $this->limpiarCampos();
        } else {
            $estudiante = Estudiante::find($this->_id);
            $estudiante->nombres = $this->nombres;
            $estudiante->direccion = $this->direccion;
            $estudiante->edad = $this->edad;
            $estudiante->save();
        }
            
        //$this->cerrarModalAgrega();
    }


    public function limpiarCampos(){
        $this->nombres = "";
        $this->apellidos = "";
        $this->edad = 0;
    }

    public function cerrarModalAgrega(){
        $this->dispatchBrowserEvent('estudianteModalAgrega');
    }


    public function render()
    {
        if( $this->criterio == "" ) {
            $estudiantes = Estudiante::paginate(4);
        } else {
            $estudiantes = Estudiante::where('nombres', 'like',"%$this->criterio%")->paginate(4);
        }
        //dd( $estudiantes);
        return view('livewire.estudianteComp', compact('estudiantes'));
    }
}
