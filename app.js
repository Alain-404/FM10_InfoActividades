function loadImage(url) {
    return new Promise(resolve => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = "blob";
        xhr.onload = function (e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const res = event.target.result;
                resolve(res);
            }
            const file = this.response;
            reader.readAsDataURL(file);
        }
        xhr.send();
    });
}

window.addEventListener('load', async () => {

    const form = document.querySelector('#completador');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let proceso = document.getElementById('proceso').value;
        let idlocal = document.getElementById('idlocal').value;
        let odpe = "PUNO / " + document.getElementById('provincia').value;
        let ccpp = document.getElementById('distrito').value + " . " + document.getElementById('ccpp').value;

        let nombres = document.getElementById('nombre').value +" "+ document.getElementById('apellido').value;

        let DNI = document.getElementById('DNI').value;

        
        let cd_DNI = document.getElementById('cd_DNI').value;
        let nombre_cd = document.getElementById('nombre_cd').value;

        let dif_entrega = document.getElementById('dif_entrega').value;
        let re_entrega = document.getElementById('re_entrega').value;
        let dif_difusion = document.getElementById('dif_difusion').value;
        let re_difusion = document.getElementById('re_difusion').value;

        let dif_aco = document.getElementById('dif_aco').value;
        let re_aco = document.getElementById('re_aco').value;
        let dif_jo = document.getElementById('dif_jo').value;
        let re_jo = document.getElementById('re_jo').value;
        let dif_pos = document.getElementById('dif_pos').value;
        let re_pos = document.getElementById('re_pos').value;
        let dif_dev = document.getElementById('dif_dev').value;
        let re_dev = document.getElementById('re_dev').value;
        
        let habilitacion = document.querySelector('input[name="habilitacion"]:checked').value;        
        let rendicion = document.querySelector('input[name="rendicion"]:checked').value;
        

        generatePDF(proceso, idlocal, odpe, ccpp, nombres, DNI, cd_DNI, nombre_cd, habilitacion, rendicion, dif_entrega, re_entrega, dif_difusion, re_difusion, dif_aco, re_aco, dif_jo, re_jo, dif_pos, re_pos, dif_dev, re_dev);
    })

});

async function generatePDF(proceso, idlocal, odpe, ccpp, nombres, DNI, cd_DNI, nombre_cd, habilitacion, rendicion, dif_entrega, re_entrega, dif_difusion, re_difusion, dif_aco, re_aco, dif_jo, re_jo, dif_pos, re_pos, dif_dev, re_dev) {
    const image = await loadImage("pagina1.jpg");
    const image1 = await loadImage("pagina2.jpg");

    const pdf = new jsPDF('p','mm','a4'); //letter

    pdf.addImage(image, 'PNG', 0, 0, 210, 297);
    

    const date = new Date();
    let fecha = date.getUTCDate().toString() + " / " + (date.getUTCMonth() + 1).toString() + " / " + date.getUTCFullYear().toString();

    pdf.setFontSize(10);
    let pro = pdf.splitTextToSize("ELECCIONES REGIONALES Y MUNICIPALES - 2022", 55);
    pdf.text(pro, 51, 47);
    //pdf.setFontSize(11);
    pdf.text(idlocal, 51, 57);
    pdf.text(odpe, 146, 48);
    let cp = pdf.splitTextToSize(ccpp, 46);
    pdf.text(cp, 146, 56);

    pdf.text(nombre_cd, 46, 99); 
    pdf.text(nombres, 46, 108);

    pdf.text(DNI, 145, 198);
    pdf.text(fecha, 151, 202);

    pdf.text(cd_DNI, 145, 238);
    pdf.text(fecha, 151, 242);

    pdf.text("DNI JODPE", 120, 276);
    pdf.text(fecha, 125, 281);

    pdf.setFillColor(0,0,0);
    if (parseInt(habilitacion) === 0) {
        pdf.circle(154, 165, 2, 'FD');
    } else {
        pdf.circle(144, 165, 2, 'FD');
    }

    if (parseInt(rendicion) === 0) {
        pdf.circle(153, 170, 2, 'FD');
    } else {
        pdf.circle(143, 170, 2, 'FD');
    }

    pdf.addPage('a4');
    pdf.addImage(image1, 'PNG', 0, 0, 210, 297);

    let di_entrega = pdf.splitTextToSize(dif_entrega, 75);
    let r_entrega = pdf.splitTextToSize(re_entrega, 60);
    let di_difusion = pdf.splitTextToSize(dif_difusion, 75);
    let r_difusion = pdf.splitTextToSize(re_difusion, 60);

    pdf.text(di_entrega, 47, 77);
    pdf.text(r_entrega, 132, 77);
    pdf.text(di_difusion, 47, 91);
    pdf.text(r_difusion, 132, 91);

    //pdf.text(dif_aco, 55, 134);
    let di_aco = pdf.splitTextToSize(dif_aco, 65);
    let r_aco = pdf.splitTextToSize(re_aco, 60);
    let di_jo = pdf.splitTextToSize(dif_jo, 65);
    let r_jo = pdf.splitTextToSize(re_jo, 60);
    let di_pos = pdf.splitTextToSize(dif_pos, 65);
    let r_pos = pdf.splitTextToSize(re_pos, 60);
    let di_dev = pdf.splitTextToSize(dif_dev, 65);
    let r_dev = pdf.splitTextToSize(re_dev, 60);

    pdf.text(di_aco, 55, 139);
    pdf.text(r_aco, 132, 139);
    pdf.text(di_jo, 55, 177);
    pdf.text(r_jo, 132, 177);
    pdf.text(di_pos, 55, 217);
    pdf.text(r_pos, 132, 217);
    pdf.text(di_dev, 55, 258);
    pdf.text(r_dev, 132, 258);


    pdf.save("[" + DNI + "] INFORME DE ACTIVIDADES.pdf");

}