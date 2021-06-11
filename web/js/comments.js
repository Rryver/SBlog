//Добавление коментария
$(document).ready(function () {
    $(".form-comment").on('beforeSubmit', function () {
        let $form = $(this);
        $formData = $form.serializeArray();
        $formData.push({name: "postId", value: $form.attr('postid')});
        console.log($formData);

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $formData
        }).done(function (data) {
            if (data.error == null) {
                $(".post__comments").html("");
                $('.post__comments').append(data);
            } else {
                $('.ajax-test').text(data.error)
            }
        }).fail(function () {
            console.log("error");
        });
        return false;
        ;
    })
});

//Редактирование коментария
// $(document).ready(function () {
//     $(".comment-edit__btn_edit").on("click", function () {
//         alert("qwe");
//     });
// });

//Удаление коментария
$(document).ready(function () {
    $("body").delegate(".comment-edit__btn_delete", "click", function () {
        if (confirm("Вы уверены, что хотите удалить коментарий")) {
            $data = [{name: "commentId", value: $(this).parent().attr('commentid')}];
            console.log($data);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $data,
            }).done(function (comments) {
                $(".post__comments").html("");
                $('.post__comments').append(comments);
            }).fail(function () {
                console.log("error");
            })
        }
    });
});