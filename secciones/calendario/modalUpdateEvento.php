<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingreso de Asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
  <form name="formEventoUpdate" id="formEventoUpdate" action="UpdateEvento.php" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="idEvento" id="idEvento">
    <div class="form-group">
      <label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" readonly/>
      </div>
    </div>

    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="horainicio" class="col-sm-4 control-label">Hora</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="horainicio" id="horainicio" placeholder="Hora" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="horainicio" class="col-sm-4 control-label">Modalidad</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="modalidad" id="modalidad" placeholder="Modalidad" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="estado" class="col-sm-4 control-label">Estado</label>
      <div class="col-sm-10">
      <select id="estado" name="estado" class="form-select">
        <option selected>Seleccione</option>
        <option value="Asistencia">Asistencia</option>
        <option value="Inasistencia">Inasistencia</option>
        </select>
      </div>
    </div>

    <div class="col-md-12 activado">
 
      <input type="radio" name="color_evento" id="amberUpd" value="#FFC107">  
      <label for="amberUpd" class="circu" style="background-color: #FFC107;"> </label>

      <input type="radio" name="color_evento" id="tealUpd" value="#009688">  
      <label for="tealUpd" class="circu" style="background-color: #009688;"> </label>

      <input type="radio" name="color_evento" id="indigo" value="#DF4268">  
  <label for="indigo" class="circu" style="background-color: #DF4268;"> </label>
    </div>

    
     <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar Cambios de mi Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
  </form>
      
    </div>
  </div>
</div>