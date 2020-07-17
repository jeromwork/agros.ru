"use strict";
$(document).ready(function() {
    var $window = $(window);
    //add id to main menu for mobile menu start
    var getBody = $("body");
    var bodyClass = getBody[0].className;
    $(".main-menu").attr('id', bodyClass);
    //add id to main menu for mobile menu end

    // card js start
    $(".card-header-right .close-card").on('click', function() {
        var $this = $(this);
        $this.parents('.card').animate({
            'opacity': '0',
            '-webkit-transform': 'scale3d(.3, .3, .3)',
            'transform': 'scale3d(.3, .3, .3)'
        });

        setTimeout(function() {
            $this.parents('.card').remove();
        }, 800);
    });

    $(".card-header-right .minimize-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        var card = $(port).children('.card-block').slideToggle();
        $(this).toggleClass("icon-minus").fadeIn('slow');
        $(this).toggleClass("icon-plus").fadeIn('slow');
    });
    $(".card-header-right .full-card").on('click', function() {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("icon-maximize");
        $(this).toggleClass("icon-minimize");
    });

    $("#more-details").on('click', function() {
        $(".more-details").slideToggle(500);
    });
    $(".mobile-options").on('click', function() {
        $(".navbar-container .nav-right").slideToggle('slow');
    });
    // card js end
    $.mCustomScrollbar.defaults.axis = "yx";
    $("#styleSelector .style-cont").slimScroll({
        setTop: "10px",
        height:"calc(100vh - 440px)",
    });
    $(".main-menu").mCustomScrollbar({
        setTop: "10px",
        setHeight: "calc(100% - 80px)",
    });
    /*chatbar js start*/

    /*chat box scroll*/
    var a = $(window).height() - 80;
    $(".main-friend-list").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5,
        color: '#1b8bf9'
    });

    // search
    $("#search-friends").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    // open chat box
    $('.displayChatbox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat').toggle('slide', options, 500);
    });


    //open friend chat
    $('.userlist-box').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
    });
    //back to main chatbar
    $('.back_chatBox').on('click', function() {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    // /*chatbar js end*/
    $(".search-btn").on('click', function() {
        $(".main-search").addClass('open');
        $('.main-search .form-control').animate({
            'width': '200px',
        });
    });
    $(".search-close").on('click', function() {
        $('.main-search .form-control').animate({
            'width': '0',
        });
        setTimeout(function() {
            $(".main-search").removeClass('open');
        }, 300);
    });
    $('#mobile-collapse i').addClass('icon-toggle-right');
    $('#mobile-collapse').on('click', function() {
        $('#mobile-collapse i').toggleClass('icon-toggle-right');
        $('#mobile-collapse i').toggleClass('icon-toggle-left');
    });
});
$(document).ready(function() {
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $('.theme-loader').fadeOut('slow', function() {
        $(this).remove();
    });
});

// toggle full screen
function toggleFullScreen() {
    var a = $(window).height() - 10;
    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
    $('.full-screen').toggleClass('icon-maximize');
    $('.full-screen').toggleClass('icon-minimize');
}



$(document).ready(function() {

    var firebaseConfig = {
        apiKey: "AIzaSyBwx9ZVAh1zpd9STFa9lcWxGaRxeTmHwpk",
        authDomain: "polnopole.firebaseapp.com",
        databaseURL: "https://polnopole.firebaseio.com",
        projectId: "polnopole",
        storageBucket: "polnopole.appspot.com",
        messagingSenderId: "792696423797",
        appId: "1:792696423797:web:f2830f79a498b0263dbf3c",
        measurementId: "G-5R2Y705ED3"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      //firebase.analytics();
      // Create a Recaptcha verifier instance globally
      // Calls submitPhoneNumberAuth() when the captcha is verified
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container", {
          size: "normal",
          callback: function(response) {
            submitPhoneNumberAuth();
          }
        }
      );

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
      function submitPhoneNumberAuth() {
          
        var phoneNumber = document.getElementById("phoneNumber").value;
        var appVerifier = window.recaptchaVerifier;
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
            $('#phoneNC').hide();
            $('#codeNc').show();

          })
          .catch(function(error) {
            console.log(error);
$("#phoneNumberErr").show();
          });
      }

      // This function runs when the 'confirm-code' button is clicked
      // Takes the value from the 'code' input and submits the code to verify the phone number
      // Return a user object if the authentication was successful, and auth is complete
      function submitPhoneNumberAuthCode() {
        var code = document.getElementById("phone_code").value;
        confirmationResult
          .confirm(code)
          .then(function(result) {
            var user = result.user;
            
            let formData = new FormData();
            formData.append("checkfire", "check");
            formData.append("idToken", user.ra);
            formData.append("key", user.l);
            formData.append("uid", user.uid);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', "?login=Phone")
            //xhr.responseType = 'json';
            xhr.send(formData);


            xhr.onload = () => {

              let r = JSON.parse(xhr.response);
              //console.log(r);
              if (r.redirect) {

                document.location.href = window.location.origin + r.redirect;
              } else {
                console.log(r)
              }

            };

            //console.log('dfswe');
          })
          .catch(function(error) {
            //console.log(error);
            $("#phone_code_err").show();
          });
      }

      //This function runs everytime the auth state changes. Use to verify if the user is logged in
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
         // console.log(user);

        } else {
          // No user is signed in.
          console.log("USER NOT LOGGED IN");
        }
      });

      function checkFire() {
        event.preventDefault();
        let formData = new FormData();
        firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            formData.append("idToken", user.ra);
            formData.append("key", user.l);
            formData.append("uid", user.uid);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', "/")
            //xhr.responseType = 'json';
            xhr.send(formData);


            xhr.onload = () => console.log(xhr.response);
            //console.log(user);
          } else {
            // No user is signed in.
            console.log("USER NOT LOGGED IN");
          }
        });
      }

  // /*chatbar js end*/
    $("#sign-in-button").on('click', submitPhoneNumberAuth);
    $("#confirm-code").on('click', submitPhoneNumberAuthCode);

    $('#phoneNumber').keypress(function (e) {    if (e.which == 13) {        $("#sign-in-button").trigger("click")    }  });
    $('#phone_code').keypress(function (e) {    if (e.which == 13) {        
        submitPhoneNumberAuthCode();   
        $('#modal_login').modal('hide'); 
        $('#success_modal_login').modal('toggle');
    }  });












  

    function init() {
        // Подключаем поисковые подсказки к полю ввода.
        var suggestView = new ymaps.SuggestView('suggest');
            
            var placemark;
            var map = new ymaps.Map('map', {
                center: [55.74, 37.58],
                zoom: 13,
                controls: []
            });
        // При клике по кнопке запускаем верификацию введёных данных.
        $('#suggest').bind('change ', function (e) {
            geocode();
        });
    
        function geocode() {
            // Забираем запрос из поля ввода.
            var request = $('#suggest').val();
            
            // Геокодируем введённые данные.
            ymaps.geocode(request).then(function (res) {
                var obj = res.geoObjects.get(0),
                    error, hint;
   
                if (obj) {
                    // Об оценке точности ответа геокодера можно прочитать тут: https://tech.yandex.ru/maps/doc/geocoder/desc/reference/precision-docpage/
                    switch (obj.properties.get('metaDataProperty.GeocoderMetaData.precision')) {
                        case 'exact':
                            break;
                        case 'number':
                        case 'near':
                        case 'range':
                            error = 'Неточный адрес, требуется уточнение';
                            hint = 'Уточните номер дома';
                            break;
                        case 'street':
                            error = 'Неполный адрес, требуется уточнение';
                            hint = 'Уточните номер дома';
                            break;
                        case 'other':
                        default:
                            error = 'Неточный адрес, требуется уточнение';
                            hint = 'Уточните адрес';
                    }
                } else {
                    error = 'Адрес не найден';
                    hint = 'Уточните адрес';
                }
    
                // Если геокодер возвращает пустой массив или неточный результат, то показываем ошибку.
                if (error == undefined) {
                    showError(error);
                    showMessage(hint);
                } else {
                    showResult(obj);
                }
            }, function (e) {
                console.log(e)
            })
    
        }
        function showResult(obj) {
             
            // Удаляем сообщение об ошибке, если найденный адрес совпадает с поисковым запросом.
            $('#suggest').removeClass('input_error');
            $('#notice').css('display', 'none');
    
            var mapContainer = $('#map'),
                bounds = obj.properties.get('boundedBy'),
            // Рассчитываем видимую область для текущего положения пользователя.
                mapState = ymaps.util.bounds.getCenterAndZoom(
                    bounds,
                    [mapContainer.width(), mapContainer.height()]
                ),
            // Сохраняем полный адрес для сообщения под картой.
                address = [obj.getCountry(), obj.getAddressLine()].join(', '),
            // Сохраняем укороченный адрес для подписи метки.
                shortAddress = [obj.getThoroughfare(), obj.getPremiseNumber(), obj.getPremise()].join(' ');
            // Убираем контролы с карты.
            //mapState.controls = [];
            // Создаём карту.

console.log(obj);
            createMap(mapState, shortAddress);
            // Выводим сообщение под картой.
           
            showMessage(address);
        }
    
        function showError(message) {
            $('#notice').text(message);
            $('#suggest').addClass('input_error');
            $('#notice').css('display', 'block');
            // Удаляем карту.
            if (map) {
                map.destroy();
                map = null;
            }
        }
    
        function createMap(state, caption) {
            // Если карта еще не была создана, то создадим ее и добавим метку с адресом.
            if (!map) {
                map = new ymaps.Map('map', state);
                placemark = new ymaps.Placemark(
                    map.getCenter(), {
                        iconCaption: caption,
                        balloonContent: caption
                    }, {
                        preset: 'islands#redDotIconWithCaption'
                    });
                map.geoObjects.add(placemark);
                // Если карта есть, то выставляем новый центр карты и меняем данные и позицию метки в соответствии с найденным адресом.
            } else {
                map.setCenter(state.center, state.zoom);
                placemark.geometry.setCoordinates(state.center);
                placemark.properties.set({iconCaption: caption, balloonContent: caption});
            }
        }
    
        function showMessage(message) {
            
            $('#messageHeader').text('Данные получены:');
            $('#message').text(message);
        }
    }
  
    ymaps.ready(init);

});


/* --------------------------------------------------------
        Color picker - demo only
        --------------------------------------------------------   */
$('#styleSelector').append('' +
    '<div class="selector-toggle">' +
        '<a href="javascript:void(0)"></a>' +
    '</div>' +
    '<ul>' +
        '<li>' +
            '<p class="selector-title main-title st-main-title"><b>Adminty </b>Customizer</p>' +
            '<span class="text-muted">Live customizer with tons of options</span>'+
        '</li>' +
        '<li>' +
            '<p class="selector-title">Main layouts</p>' +
        '</li>' +
        '<li>' +
            '<div class="theme-color">' +
                '<a href="#" class="navbar-theme" navbar-theme="themelight1"><span class="head"></span><span class="cont"></span></a>' +
                '<a href="#" class="navbar-theme" navbar-theme="theme1"><span class="head"></span><span class="cont"></span></a>' +
            '</div>' +
        '</li>' +
    '</ul>' +
    '<div class="style-cont m-t-10">' +
        '<ul class="nav nav-tabs  tabs" role="tablist">' +
            '<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#sel-layout" role="tab">Layouts</a></li>' +
            '<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sel-sidebar-setting" role="tab">Sidebar Settings</a></li>' +
        '</ul>' +
        '<div class="tab-content tabs">' +
            '<div class="tab-pane active" id="sel-layout" role="tabpanel">' +
                '<ul>' +
                    '<li class="theme-option">' +
                        '<div class="checkbox-fade fade-in-primary">' +
                            '<label>' +
                                '<input type="checkbox" value="false" id="sidebar-position" name="sidebar-position" checked>' +
                                '<span class="cr"><i class="cr-icon feather icon-check txt-success f-w-600"></i></span>' +
                                '<span>Fixed Sidebar Position</span>' +
                            '</label>' +
                        '</div>' +
                    '</li>' +
                    '<li class="theme-option">' +
                        '<div class="checkbox-fade fade-in-primary">' +
                            '<label>' +
                                '<input type="checkbox" value="false" id="header-position" name="header-position" checked>' +
                                '<span class="cr"><i class="cr-icon feather icon-check txt-success f-w-600"></i></span>' +
                                '<span>Fixed Header Position</span>' +
                            '</label>' +
                        '</div>' +
                    '</li>' +
                '</ul>' +
            '</div>' +
            '<div class="tab-pane" id="sel-sidebar-setting" role="tabpanel">' +
                '<ul>' +
                    '<li class="theme-option">' +
                        '<p class="sub-title drp-title">Menu Type</p>' +

                        '<div class="form-radio" id="menu-effect">'+
                            '<div class="radio radio-inverse radio-inline" data-toggle="tooltip" title="simple icon">'+
                                '<label>'+
                                    '<input type="radio" name="radio" value="st6" onclick="handlemenutype(this.value)" checked="true">'+
                                    '<i class="helper"></i><span class="micon st6"><i class="feather icon-command"></i></span>'+
                                '</label>'+
                            '</div>'+
                            '<div class="radio  radio-primary radio-inline" data-toggle="tooltip" title="color icon">'+
                                '<label>'+
                                    '<input type="radio" name="radio" value="st5" onclick="handlemenutype(this.value)">'+
                                    '<i class="helper"></i><span class="micon st5"><i class="feather icon-command"></i></span>'+
                                '</label>'+
                            '</div>'+
                        '</div>'+
                    '</li>' +
                    '<li class="theme-option">' +
                        '<p class="sub-title drp-title">SideBar Effect</p>' +
                        '<select id="vertical-menu-effect" class="form-control minimal">' +
                            '<option name="vertical-menu-effect" value="shrink">shrink</option>' +
                            '<option name="vertical-menu-effect" value="overlay">overlay</option>' +
                            '<option name="vertical-menu-effect" value="push">Push</option>' +
                        '</select>' +
                    '</li>' +
                    '<li class="theme-option">' +
                        '<p class="sub-title drp-title">Hide/Show Border</p>' +
                        '<select id="vertical-border-style" class="form-control minimal">' +
                            '<option name="vertical-border-style" value="solid">Style 1</option>' +
                            '<option name="vertical-border-style" value="dotted">Style 2</option>' +
                            '<option name="vertical-border-style" value="dashed">Style 3</option>' +
                            '<option name="vertical-border-style" value="none">No Border</option>' +
                        '</select>' +
                    '</li>' +
                    '<li class="theme-option">' +
                        '<p class="sub-title drp-title">Drop-Down Icon</p>' +
                        '<select id="vertical-dropdown-icon" class="form-control minimal">' +
                            '<option name="vertical-dropdown-icon" value="style1">Style 1</option>' +
                            '<option name="vertical-dropdown-icon" value="style2">style 2</option>' +
                            '<option name="vertical-dropdown-icon" value="style3">style 3</option>' +
                        '</select>' +
                    '</li>' +
                    '<li class="theme-option">' +
                        '<p class="sub-title drp-title">Sub Menu Drop-down Icon</p>' +
                        '<select id="vertical-subitem-icon" class="form-control minimal">' +
                            '<option name="vertical-subitem-icon" value="style1">Style 1</option>' +
                            '<option name="vertical-subitem-icon" value="style2">style 2</option>' +
                            '<option name="vertical-subitem-icon" value="style3">style 3</option>' +
                            '<option name="vertical-subitem-icon" value="style4">style 4</option>' +
                            '<option name="vertical-subitem-icon" value="style5">style 5</option>' +
                            '<option name="vertical-subitem-icon" value="style6">style 6</option>' +
                        '</select>' +
                    '</li>' +
                '</ul>' +
            '</div>' +
        '<ul>' +
            '<li>' +
                '<p class="selector-title">Header Brand color</p>' +
            '</li>' +
            '<li class="theme-option">' +
                '<div class="theme-color">' +
                    '<a href="#" class="logo-theme" logo-theme="theme1"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="logo-theme" logo-theme="theme2"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="logo-theme" logo-theme="theme3"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="logo-theme" logo-theme="theme4"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="logo-theme" logo-theme="theme5"><span class="head"></span><span class="cont"></span></a>' +
                '</div>' +
            '</li>' +
            '<li>' +
                '<p class="selector-title">Header color</p>' +
            '</li>' +
            '<li class="theme-option">' +
                '<div class="theme-color">' +
                    '<a href="#" class="header-theme" header-theme="theme1"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="header-theme" header-theme="theme2"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="header-theme" header-theme="theme3"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="header-theme" header-theme="theme4"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="header-theme" header-theme="theme5"><span class="head"></span><span class="cont"></span></a>' +
                    '<a href="#" class="header-theme" header-theme="theme6"><span class="head"></span><span class="cont"></span></a>' +
                '</div>' +
            '</li>' +
            '<li>' +
                '<p class="selector-title">Active link color</p>' +
            '</li>' +
            '<li class="theme-option">' +
                '<div class="theme-color">' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme1">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme2">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme3">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme4">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme5">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme6">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme7">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme8">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme9">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme10">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme11">&nbsp;</a>' +
                    '<a href="#" class="active-item-theme small" active-item-theme="theme12">&nbsp;</a>' +
                '</div>' +
            '</li>' +
            '<li>' +
                '<p class="selector-title">Menu Caption Color</p>' +
            '</li>' +
            '<li class="theme-option">' +
                '<div class="theme-color">' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme1">&nbsp;</a>' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme2">&nbsp;</a>' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme3">&nbsp;</a>' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme4">&nbsp;</a>' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme5">&nbsp;</a>' +
                    '<a href="#" class="leftheader-theme small" lheader-theme="theme6">&nbsp;</a>' +
                '</div>' +
            '</li>' +
        '</ul>' +
    '</div>' +
'</div>' +
'<ul>'+
    '<li>' +
        '<a href="http://html.codedthemes.com/Adminty/doc" target="_blank" class="btn btn-primary btn-block m-r-15 m-t-5 m-b-10">Online Documentation</a>' +
    '</li>' +
    '<li class="text-center">' +
        '<span class="text-center f-18 m-t-15 m-b-15 d-block">Thank you for sharing !</span>' +
        '<a href="#!" target="_blank" class="btn btn-facebook soc-icon m-b-20"><i class="feather icon-facebook"></i></a>' +
        '<a href="#!" target="_blank" class="btn btn-twitter soc-icon m-l-20 m-b-20"><i class="feather icon-twitter"></i></a>' +
    '</li>' +
'</ul>'+
'');
