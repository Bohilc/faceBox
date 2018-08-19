function confirmDeletePost(idPost) {
    var message = "Czy na pewno chcesz usunąć post id: " + idPost;
    if (confirm(message)) {
        console.log(document.getElementById("form_post_delete" + idPost));
        document.getElementById("form_post_delete_" + idPost).submit();
    }
}

function confirmDeleteComment(idPost) {
    var message = "Czy na pewno chcesz usunąć komentaż id: " + idPost;
    if (confirm(message)) {
        console.log(document.getElementById("form_comment_delete" + idPost));
        document.getElementById("form_comment_delete_" + idPost).submit();
    }
}