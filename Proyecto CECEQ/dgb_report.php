<?php include("partials/_header.html"); ?>
<?php include("partials/_top_bar.html"); ?>

<div class="container">
    <div class="row text-center">
        <div class="col col-sm-12 col-md-6 mx-auto">
            <div class="display-3">Reporte DGB</div>
        </div>
    </div><br />
    <div class="shadow">
        <br />
        <div class="row px-2">
            <div class="col">
                <form>
                    <div class="row text-center">
                        <div class="col-sm-12 col-md-4 offset-md-1 my-1">
                            <select class="form-control shadow" name="Mes">
                                <option value="" disabled selected>-- Mes --</option>
                                <option value="Enero">Enero</option>
                                <option value="Febrero">Febrero</option>
                                <option value="Marzo">Marzo</option>
                                <option value="Abril">Abril</option>
                                <option value="Mayo">Mayo</option>
                                <option value="Junio">Junio</option>
                                <option value="Julio">Julio</option>
                                <option value="Agosto">Agosto</option>
                                <option value="Septiembre">Septiembre</option>
                                <option value="Octubre">Octubre</option>
                                <option value="Noviembre">Noviembre</option>
                                <option value="Diciembre">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 offset-md-1 my-1">
                            <select class="form-control shadow" name="Mes">
                                <option value="" disabled selected>-- Año --</option>
                                <?php
                                $firstYear = 2018;
                                for($year = $firstYear; $year <= date("Y"); $year++) {
                                    echo "<option value='$year'> $year </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row text-center mt-3 my-2 px-2">
            <div class="col-sm-12">
                <b>Usuarios Atendidos</b>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-sm-12 col-md-6">
                <b>Jóvenes:</b>
            </div>
            <div class="col-sm-12 col-md-6">
                <b>Adultos:</b>
            </div>
        </div>
        <hr>
        <div class="row text-center mt-3 my-2 px-2">
            <div class="col-sm-12">
                <b>Servicio de Préstamo</b>
            </div>
        </div>
        <div class="row px-2">
            <div class="col-sm-12 col-md-6">
                <b>Credenciales expedidas:</b>
            </div>
            <div class="col-sm-12 col-md-6">
                <b>Libros prestados a domicilio:</b>
            </div>
        </div>
        <br /><br />
        <div class="row">
            <div class="col-sm-2 text-center">
                <a class="btn btn-outline-secondary py-0" href="menu.php"><i class="material-icons align-middle">arrow_back</i></a>
            </div>
        </div>
        <br />
    </div>
</div>

<?php include("partials/_footer.html"); ?>
