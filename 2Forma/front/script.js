document.getElementById("form-evento").addEventListener("submit", async function (e) {
  e.preventDefault(); // evitar recarga

  const comidas = [];
  document.querySelectorAll("input[name='comida']:checked").forEach(c => comidas.push(c.value));

  const datos = {
    nombre: document.getElementById("nombre").value,
    email: document.getElementById("email").value,
    telefono: document.getElementById("telefono").value,
    nacimiento: document.getElementById("nacimiento").value,
    genero: document.querySelector("input[name='genero']:checked")?.value,
    fechaEvento: document.getElementById("fechaEvento").value,
    entrada: document.getElementById("entrada").value,
    comidas,
    usuario: document.getElementById("usuario").value,
    pass: document.getElementById("pass").value,
    pass2: document.getElementById("pass2").value,
    notificaciones: document.getElementById("notificaciones").checked,
    terminos: document.getElementById("terminos").checked,
    calificacion: document.getElementById("calificacion").value,
    comentarios: document.getElementById("comentarios").value
  };

  const response = await fetch("api_evento.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(datos)
  });

  const resultado = await response.json();
  alert(resultado.mensaje);
});
