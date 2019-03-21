function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    if (innerWidth > 1200) {
        document.getElementById("main").style.marginLeft = "250px";

    }
    /*document.body.style.backgroundColor = "rgba(0,0,0,0.4)";*/
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    if (innerWidth > 1200) {
        document.getElementById("main").style.marginLeft = "0";

    }
    /*document.body.style.backgroundColor = "white";*/
}
