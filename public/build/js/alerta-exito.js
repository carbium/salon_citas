const deleteButtons=document.querySelectorAll("#borrar");deleteButtons.forEach(e=>{e.addEventListener("submit",(function(e){e.preventDefault(),user_confirm=confirm("¿Está seguro que desea eliminar el registro?"),user_confirm?Swal.fire({icon:"success",title:"Cita Creada",text:"Tu cita fue creada correctamente!!",button:"Ok"}):alert("La eliminación se ha cancelado")}))});