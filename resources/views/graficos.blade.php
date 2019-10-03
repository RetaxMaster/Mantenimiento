@extends('../template/template')

@section('content')
    <h1>Dashboard</h1>
    <h2>Gráficos</h2>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos realizados</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="mantenimiento-realizado" id="mantenimiento-realizado" class="form-control">
                        <option value="0">General</option>
                        @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">Sucursal</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <img style="max-width: 100%;" src="https://images.vexels.com/media/users/3/129856/isolated/lists/83b8b3382c3f8f1ac4a8b16c5388360f-colorido-grafico-circular-de-cuatro-partes.png" alt="Gráfica">
                </div>
            </div>
        </section>

        <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos por vencer</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="mantenimiento-realizado" id="mantenimiento-realizado" class="form-control">
                        <option value="0">General</option>
                        @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">Sucursal</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <img style="max-width: 100%;" src="https://images.vexels.com/media/users/3/129856/isolated/lists/83b8b3382c3f8f1ac4a8b16c5388360f-colorido-grafico-circular-de-cuatro-partes.png" alt="Gráfica">
                </div>
            </div>
        </section>

        <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos vencidos</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="mantenimiento-realizado" id="mantenimiento-realizado" class="form-control">
                        <option value="0">General</option>
                        @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">Sucursal</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <img style="max-width: 100%;" src="https://images.vexels.com/media/users/3/129856/isolated/lists/83b8b3382c3f8f1ac4a8b16c5388360f-colorido-grafico-circular-de-cuatro-partes.png" alt="Gráfica">
                </div>
            </div>
        </section>

    </main>
@endsection