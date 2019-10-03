function corrigir(id, token) {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", '/test/'+id+'/correct', true);
    ajax.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log("tudo okay");
        }
    };
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("_token="+token);
}
