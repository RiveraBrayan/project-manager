function fncSweetAlert(type, text, url, param = null) {
    switch (type) {
        /*=============================================
        Error Alert
        =============================================*/

        case "error":
            if (url == null) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: text,
                });
            } else if (url == "reload") {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        window.open(url, "_top");
                    }
                });
            }

            break;

        /*=============================================
        Success Alert
        =============================================*/

        case "success":
            if (url == null) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                });
            } else if (url == "reload") {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                });
            } else if (url == "reload_param") {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        var url = window.location.href;

                        if (url.indexOf("?") > -1) {
                            url += "&" + param;
                        } else {
                            url += "/" + param;
                        }

                        window.location.href = url;

                        // location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        window.open(url, "_top");
                    }
                });
            }

            break;

        /*=============================================
        Loading Alert
        =============================================*/

        case "loading":
            Swal.fire({
                allowOutsideClick: false,
                icon: "info",
                text: text,
            });
            Swal.showLoading();

            break;

        /*=============================================
        Cuando necesitamos cerrar la alerta suave
        =============================================*/

        case "close":
            Swal.close();

            break;

        /*=============================================
        Confirmation Alert
        =============================================*/

        case "confirm":
            return new Promise((resolve) => {
                Swal.fire({
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Yes",
                }).then(function (result) {
                    resolve(result.value);
                });
            });

            break;

        case "delete":
            return new Promise((resolve) => {
                Swal.fire({
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Yes, Delete!",
                }).then(function (result) {
                    resolve(result.value);
                });
            });

            break;

    }
}