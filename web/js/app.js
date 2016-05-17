$(function(){
    $(".liste input").click(function() {
        $(this.parentNode).slideUp();
        $.ajax({
            type: 'post',
            url: 'supprimer',
            data: { "id" : this.parentNode.dataset.id }
            })
    });
});