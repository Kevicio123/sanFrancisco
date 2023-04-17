
    </main>
    <br><br><br><br><br><br><br><br>
  <footer>

  <div class="footer-dark">
        <footer>
          <br><br><br>
            <br>
        <nav class="navbar navbar-expand navbar-dark  bg-dark ">
            <div class="container" align="center">
              <br>
              <br>
                <p class="copyright"  style="color:white">Consultorio Dental San Francisco © 2023 <br> Todos los derechos reservados </p>
                
                <br>
                <br>
            </div>
            <br>
            <br>
            <br>
            <br>
        </footer>
    </nav>
    </div>
    
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

  <script>
        var tabla= document.querySelector('#tabla');

        var dataTable = new DataTable(tabla,{
            perPage:3,
            perPageSelect:[3,6,9,12],
            "language": {
              "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
      });


    </script>

<script>
    function borrar(id){
        
        Swal.fire({
        title: '¿Desea borrar el usuario?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        } 
        })  
    }

</script>

<script>
    function borrarExamen(id){
        
        Swal.fire({
        title: '¿Desea borrar el Examen?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        } 
        })  
    }

</script>

<script>
    function borrarExamen2(id){
        
        Swal.fire({
        title: '¿Desea borrar el Examen?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="listaExamenes.php?txtID="+id;
        } 
        })  
    }

</script>

<script>
    function borrar3(id){
  
        Swal.fire({
        title: '¿Desea borrar el Tratamiento?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index2.php?txtID="+id;
        } 
        })  
    }

</script>

<script>
    function borrar4(id){
  
        Swal.fire({
        title: '¿Desea borrar la Sugerencia?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        } 
        })  
    }

</script>


<script>
    function borrarHistoria(id){
        
        Swal.fire({
        title: '¿Desea borrar la Historia Clínica?',
        showCancelButton: true,
        confirmButtonText: 'Sí, Borrar',
        }).then((result) => {
  
        if (result.isConfirmed) {
        window.location="index.php?txtID="+id;
        } 
        })  
    }

</script>






  </body>
  
  </html>