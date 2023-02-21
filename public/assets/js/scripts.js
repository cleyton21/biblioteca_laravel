window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// $(function () {
//     $("form").submit(function (e) {
//     e.preventDefault();

//     var form = $(this);
//     var load = $(".ajax_load");
//     load.fadeIn(200).css("display", "flex");

//     $.ajax({
//         url: form.attr("action"),
//         type: "POST",
//         data: form.serialize(),
//         dataType: "json",
//         success: function (response) {
//             if(response.success === true) {
//                 //redirecionar
//                 // window.location.href = response.redirect;
//             } else {
//                 $('.messageBox').removeClass('d-none').html(response.message).toggleClass("bounce");
//                 // window.location.href = response.redirect;
//             }

//         },
//         error: function (response) {
           

//         },
//         complete: function(){
//             load.fadeOut(200);
//         }
//     });
//   });
// });

