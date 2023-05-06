function func_GovLookup() {
    $("#popup_container").load("http://localhost/includes/func_govlookup.php")
}

function govLookup() {
    var e = "http://localhost/includes/func_govlookup.php?plate=" + document.getElementById("mat-input-2").value,
        o = document.getElementById("loadingbar");
    o.classList.add("active"), $("#popup_container").load(e, function() {
        o.classList.remove("active")
    })
}

function criminalRecord() {
    var e = "http://localhost/includes/func_criminalrecord.php?name=" + document.getElementById("mat-input-0").value.replace(" ", "_"),
        o = document.getElementById("loadingbar");
    o.classList.add("active"), $("#criminal_results").load(e, function() {
        o.classList.remove("active")
    })
}