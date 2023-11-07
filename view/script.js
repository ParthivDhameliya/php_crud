function pagination(pagenumber, id) {
    $(".page-item").removeClass('active');

    $("#"+id).addClass('active');
    
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.ready == 4 && this.status == 200 ) {
            
        }
    };
    
    xhr.open('POST', '/curd/model/database_home.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("page="+pagenumber);
}