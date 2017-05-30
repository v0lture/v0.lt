function shorten() {
    var link = $("#shortenlink").val();

    if(link !== ""){
        $("#shorten-prompt").slideUp();
        $("#shorten-finished").slideUp();
        $("#shorten-loader").slideDown();

        $.ajax("api/shorten.php?create="+link, {
            success: (d) => {
                $("#shorten-loader").slideUp();
                $("#shorten-finished").slideDown();

                var data = d[0];
                if(data.error === null){
                    $("#shorten-finished > p").html("Your short link for <code>"+link+"</code> is ready and can be used with <code>"+data.data.short+"</code>.");
                } else {
                    $("#shorten-finished > p").html("Failed to create short link. <br />Code &mdash; <code>"+data.error.code+"</code><br />Message &mdash; <code>"+data.error.message+"</code>");
                }

            },
            error: (e) => {
                $("#shorten-loader").slideUp();
                $("#shorten-finished").slideDown();
                $("#shorten-finished > p").html("Failed to create short link. <br />An ajax error occurred.");
            }
        });
    }
}

function resetShorten() {
    $("#shorten-finished").slideUp();
    $("#shorten-loader").slideUp();
    $("#shorten-prompt").slideDown();
}