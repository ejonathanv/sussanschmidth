  /**
 * scripts.js
 * 
 * Este archivo contiene el objeto principal 'app' y una serie de componentes JavaScript
 * para la funcionalidad de la interfaz de usuario como navegación, subida de imágenes,
 * modales y confirmación de acciones destructivas (como eliminar elementos).
 *
 * Estructura principal: 
 * - app               : Objeto principal que inicializa todos los componentes.
 * - app.components    : Agrupa módulos funcionales (nav, uploadImg, modal, removeItem).
 */

var app = {
      /**
     * Inicializa los componentes cuando se carga la aplicación.
     * - Deshabilita los links con href = "#"
     * - Inicializa la navegación móvil
     * - Inicializa la funcionalidad de subida de imágenes
     * - Inicializa la funcionalidad de modales
     * - Inicializa la funcionalidad de confirmación para eliminación de elementos
     */
    render: function () {
        var t = app.components;
          // Previene el comportamiento por defecto de los enlaces que tienen href="#"
        $('a[href="#"]').click(function (i) {
            i.preventDefault();
        });
          // Inicializa el menú para dispositivos móviles
        t.nav.mobile();
          // Inicializa la función para subir imágenes
        t.uploadImg.click();
          // Inicializa el sistema de modales
        t.modal.click();
          // Inicializa la confirmación para eliminar elementos
        t.removeItem();
    },

      /**
     * Componentes/lógica encapsulada por funcionalidad.
     */
    components: {
          /**
         * Funciones relacionadas con la navegación.
         */
        nav: {
              // Muestra el primer submenu del nav con slideDown (No usado por defecto)
            slidedown: function () {
                setTimeout(function () {
                    $("nav li").first().find("ul").slideDown("slow");
                }, 700);
            },
              // Habilita la navegación móvil mostrando/ocultando el menú lateral
            mobile: function () {
                $("#app-nav-btn").click(function () {
                    $("#app-nav").toggleClass("active");
                });
            },
        },

          /**
         * Funcionalidad para cargar imágenes en formularios: 
         * Permite seleccionar y previsualizar una imagen al hacer click en un botón.
         */
        uploadImg: {
              // Inicializa los listeners de subida y previsualización
            click: function () {
                  // Al hacer click en el botón, dispara el input file oculto
                $("#upload-img-btn").click(function () {
                    $("#upload-img-input").click();
                });
                  // Cuando se selecciona la imagen, lee el archivo y previsualiza
                $("#upload-img-input").change(function () {
                    app.components.uploadImg.readURL(this);
                });
            },
              // Lee el archivo seleccionado y actualiza la imagen de fondo del botón
            readURL: function (input) {
                if (input.files && input.files[0]) {
                    var reader        = new FileReader();
                        reader.onload = function (e) {
                        $("#upload-img-btn").css({
                            "background-image": "url(" + e.target.result + ")",
                        });
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            },
        },

          /**
         * Componentes y métodos para la generación de modales genéricos (popups).
         */
        modal: {
              /**
             * Crea un modal inyectando HTML personalizado dentro de la estructura del modal.
             * @param {HTMLElement|jQuery|string} modalHtml - Contenido a mostrar dentro del modal.
             */
            create: function (modalHtml) {
                var html = {
                    box : $("<div/>", { class: "modal-box" }),
                    cont: $("<div/>", { class: "modal-cont" }),
                    help: $("<div/>", { class: "modal-h" }),
                };
                html.box
                    .append(html.cont.html(modalHtml))
                    .append(html.help)
                    .appendTo("body");
            },

              /**
             * Elimina/cierra el modal cuando se hace click fuera de su contenido.
             */
            remove: function () {
                $(document).on("click", ".modal-box", function (e) {
                      // Elimina la clase active y en 300ms elimina el modal del DOM
                    $(".modal-box").removeClass("active");
                    setTimeout(function () {
                        $(".modal-box").remove();
                        $("body").removeClass("noScroll");
                    }, 300);
                });
            },

              /**
             * Busca los elementos con el atributo data-modal y los convierte en triggers de modales de imagen.
             */
            click: function () {
                $("[data-modal]").each(function () {
                    var modal = $(this);
                    modal.click(function () {
                        var image = $(this).data("modal");
                          // Crea el tag IMG con la imagen a mostrar en modal
                        var modalHtml = $("<img/>", { src: image });
                        $("body").addClass("noScroll");
                          // Crea y muestra el modal de imagen
                        $.when(app.components.modal.create(modalHtml)).then(
                            function () {
                                setTimeout(function () {
                                    $(".modal-box").addClass("active");
                                }, 150);
                            }
                        );
                    });
                    app.components.modal.remove();
                });
            },
        },

          /**
         * Agrega confirmación modal para la eliminación de elementos mediante formularios.
         */
        removeItem: function () {
            $(".remove-item-form").submit(function (e) {
                e.preventDefault();  // Previen submit automático
                var $form = this;
                  // HTML de confirmación para el modal (Sí/No)
                var confirm = 
                    '<div class="confirm-box">' +
                    '<p>Are you sure you want to delete this file?</p>' +
                    '<div class="confir-box-footer">' +
                    '<a class="btn btn-default" id="close-confirm-box">No, just close this window</a> <a class="btn btn-default" id="success-confirm-box">Yes, i want delete it</a>';
                "</footer>" + "</div>";
                  // Crea el modal de confirmación
                $.when(app.components.modal.create(confirm)).then(function () {
                    setTimeout(function () {
                        $(".modal-box").addClass("active");
                        app.components.modal.remove();
                    }, 150);
                });
                  // Si el usuario cancela, cierra el modal
                $("#close-confirm-box").click(function () {
                    $(".modal-box").removeClass("active");
                    setTimeout(function () {
                        $(".modal-box").remove();
                        $("body").removeClass("noScroll");
                    }, 300);
                });
                  // Si el usuario confirma, envía nuevamente el submit
                $("#success-confirm-box").click(function () {
                    $form.submit();
                });
                return false;
            });
        },
    },
};

  // Inicialización de la aplicación al cargar scripts.js
app.render();
