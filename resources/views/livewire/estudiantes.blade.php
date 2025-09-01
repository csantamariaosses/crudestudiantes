<div>
    <div class="container">
        <div class="my-5">  
            <div class="row">     
                <div class="col-5">                     
                    <input type="text" class="form-control" wire:model="criterio" placeholder="busqueda">
                </div>
       
                <div class="col-5">                     
                    <button class="btn btn-primary rounded">Buscar</button>
                    <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#estudianteModalAgrega" wire:click="agregar">
                        Agregar..
                        </button>
                </div>
            </div>
        </div>

        <br>
        <p>Explicacion de config de discos para subida de archivos</p>
        <p>https://www.google.com/search?q=laravel+como+configurar+filesystem+config+para+carga+de+archivos&rlz=1C1GCEA_enCL1137CL1137&oq=laravel+como+configurar+filesystem+config+para+carga+de+archivos&gs_lcrp=EgZjaHJvbWUyBggAEEUYOdIBCjIzNzM1ajBqMTWoAgiwAgHxBX14GVlBHQQc8QV9eBlZQR0EHA&sourceid=chrome&ie=UTF-8</p>
        <br>

        <div class="my-5">  
            <div class="row">     
                <div class="col-8">                     
                    <table class="table  table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $estudiantes as $estudiante)
                        <tr>
                        <th scope="row">{{$estudiante->id}}</th>
                        <td>{{$estudiante->nombres}}</td>
                        <td>{{$estudiante->direccion}}</td>
                        <td>{{$estudiante->edad}}</td>
                        <td><img src="{{asset('storage/imagenes/'.$estudiante->imagen)}}" width="50"></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditaRegistro" wire:click="edit({{$estudiante->id}})">Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete" wire:click="deleteConfirm({{$estudiante->id}})">Delete</button>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{ $estudiantes->links() }}
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Nuevo -->
    @include('components.modalheader')

    <div class="mb-3">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nombres" placeholder="nombres" wire:model.lazy="nombres" required>
        @error('nombres')
            <span style="color:red">{{ $message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Direccion</label>
        <input type="text" class="form-control" id="direccion" placeholder="direccion" wire:model.lazy="direccion">
    </div>
    <div class="mb-3">
        <label for="edad" class="form-label">Edad</label>
        <input type="number" class="form-control" id="edad" placeholder="0" wire:model.lazy="edad">
    </div>
        <div class="mb-3">
        <label for="archivo" class="form-label">Archivo</label>
        <input type="file" class="form-control" id="imagen"  wire:model="imagen">
        
        
    </div>
    @include('components.modalfooter')
    <!-- Fin Modal Nuevo --> 

  
    <!-- Modal Confirm Delete --> 
     @include('components.modalConfirmHeaderDelete')
     <p>Seguro desea eliminar {{$_id}}?</p>
     @include('components.modalConfirmFooterDelete')
    <!-- Fin Modal Confirm Delete -->


    <!-- Modal Edita Simplificado -->
    <div class="modal fade" id="modalEditaRegistro" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Estudiante Simplificado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" placeholder="nombres" wire:model.lazy="nombres">
            </div>
            <div class="mb-3">
                <label for="Direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" placeholder="direccion" wire:model.lazy="direccion">
            </div>
            <div class="mb-3">
                <label for="Edad" class="form-label">Edad:</label>
                <input type="number" class="form-control" id="edad" placeholder="edad" wire:model.lazy="edad">
            </div>            
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen actual:</label>               
                <img src="{{asset('storage/imagenes/'.$imagen)}}" width="200">
            </div>                        
            <div class="mb-3">
                <label for="imagenNueva" class="form-label">Nueva imagen:</label>
                <input type="file" class="form-control" id="imagen"  wire:model="imagen">
            </div>                        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" wire:click="store">Save changes</button>
        </div>
        </div>
    </div>
    </div>            

    <!-- Fin Modal Edita Simplificado-->
</div>