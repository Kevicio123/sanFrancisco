
</main>
  <footer>
    
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
