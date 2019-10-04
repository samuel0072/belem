var reader = new FileReader();
reader.onload = (evt) => {
    var csvText = evt.target.result;
    var csvObject = $.csv.toObjects(csvText);
    doIt(csvObject);
};

function getRawData(inputFile) {
    var rawCsv = inputFile[0];
    reader.readAsText(rawCsv);
}

function doIt(csv) {
    csv.forEach((element) => {
        resp = Object.values(element);
        console.log();
        studentEnroll = resp[0];

    });
}
