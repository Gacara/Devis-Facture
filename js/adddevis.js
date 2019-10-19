$(document).ready(function () {
    var body = $('body');
    var del = 0;
    $('.btn-delete-presta').hide();//Cache le btn delete de base afin de pas suppr le form de base
    var toto = 0;
    var tabpresta = [];
    var g = 1;
    $(body).on('click', '.btn-add-presta', function () {
        var copie = $('.prestation:last').clone();
        var get_second_class = copie.attr('class').split(' ');
        copie.addClass('' + g).removeClass(get_second_class[1]);
        copie.find('.presta_nom').val('').addClass('' + g).removeClass('0');;
        copie.find('.presta_prix').val('').addClass('' + g).removeClass('0');
        copie.find('.presta_quantite').val('').addClass('' + g).removeClass('0');
        copie.find('.presta_montant').val('').addClass('' + g).removeClass('0');
        copie.insertBefore('.btn_clone');
        copie.insertAfter(".prestation:last");
        $('.btn-delete-presta:last').show();
        g++;
    });

    $(body).on("click", ".btn-delete-presta", function () {
        const get_tr = $(this).parent().parent();
        $(get_tr).remove();

        var num_presta = $('.prestation').length;//Get le nb de tr avec la class prestation
        var total = "0";

        for (var nb = 0; nb < num_presta; nb++) {//Boucle afin d'avoir le total de tout les montants
            var get = $('.' + nb).find('.presta_montant').val();
            total = (parseInt(total) + parseInt(get));
            $("#montant_tht").val(total);
            const tva = (total * 0.2);
            const ttc = (tva + total);
            $("#montant_tva").val(tva);
            $("#montant_ttc").val(ttc);
        }
        del = 1;
        toto = $("#montant_tht").val();
    });

    $(body).on("click", ".btn-refresh_montant", function () {
         var total = "0";
        for (var nb = 0; nb < 3; nb++) {

            var get_montant_spe = $('.' + nb).find('.presta_montant.' + nb).val();


            if (!isNaN(get_montant_spe)) {
                total = (parseInt(total) + parseInt(get_montant_spe));
                $("#montant_tht").val(total);
                const tva = (total * 0.2);
                const ttc = (tva + total);
                $("#montant_tva").val(tva);
                $("#montant_ttc").val(ttc);
                }

 // var get_all_presta = $("allpresta").child().attr('class').split(' ');
           
             

            var get_upresta = $("tr").find('.prestation.' + nb).attr('class');
            alert(get_upresta);
            var get_upresta_nom = $(get_upresta).find('.presta_nom').val();
            var get_upresta_prix = $(get_upresta).find('.presta_prix').val();
        //     var get_upresta_quantite = $(get_upresta).find('.presta_quantite').val();
          //  var set_upresta_montant = $(get_upresta).find('.presta_montant').val();
            
           // var upresta = [get_upresta_nom,get_upresta_prix,get_upresta_quantite,get_upresta_montant];
            var upresta = [get_upresta_nom,get_upresta_prix];
            tabpresta[nb] = upresta ;
            console.log(tabpresta);
            
        }
    });

    $(body).on("input", ".presta_prix", function () {
        var get_class = $(this).parent().parent().attr('class').split(' ');//Get all class of tr.prestation
        var get_class_nb = get_class[1];//Get the second class (le nb)
        var get_parent_class = "." + get_class_nb;//.[nb]

        var get_presta_prix = $(get_parent_class).find('.presta_prix').val();//valeur presta_prix
        var get_presta_quantite = $(get_parent_class).find('.presta_quantite').val();//valeur presta_quantite
        var set_presta_montant = $(get_parent_class).find('.presta_montant');//recup de l'input afin de le modif

        const total_montant = (get_presta_prix * get_presta_quantite);//Calcul montant de la presta
        $(set_presta_montant).val(total_montant);
        
        var num_presta = $('.prestation').length;//Get le nb de tr avec la class prestation
        var total = "0";

        if (del === 1) {
            for (var nb = 0; nb < num_presta; nb++) {//Boucle afin d'avoir le total de tout les montants
                var get_class2 = $(this).attr('class').split(' ');//Get all class of tr.prestation
                var get_class_nb2 = get_class2[2];//Get the second class (le nb)
                var get_parent_class2 = "." + get_class_nb2;//.[nb]
            }
            var get_montant_spe = $(get_parent_class2).find('.presta_montant.' + get_class_nb2).val();
            total = (parseInt(toto) + parseInt(get_montant_spe));
            $("#montant_tht").val(total);
            const tva = (total * 0.2);
            const ttc = (tva + total);
            $("#montant_tva").val(tva);
            $("#montant_ttc").val(ttc);
        }
        else {
            for (var nb = 0; nb < num_presta; nb++) {//Boucle afin d'avoir le total de tout les montants
                var get = $('.' + nb).find('.presta_montant').val();
                total = (parseInt(total) + parseInt(get));
                $("#montant_tht").val(total);
                const tva = (total * 0.2);
                const ttc = (tva + total);
                $("#montant_tva").val(tva);
                $("#montant_ttc").val(ttc);
            }
        }
    });


    $(body).on("input", ".presta_quantite", function () {
        var get_class = $(this).parent().parent().attr('class').split(' ');//Get all class of tr.prestation
        var get_class_nb = get_class[1];//Get the second class (le nb)
        var get_parent_class = "." + get_class_nb;//.[nb]

        var get_presta_prix = $(get_parent_class).find('.presta_prix').val();//valeur presta_prix
        var get_presta_quantite = $(get_parent_class).find('.presta_quantite').val();//valeur presta_quantite
        var set_presta_montant = $(get_parent_class).find('.presta_montant');//recup de l'input afin de le modif

        const total_montant = (get_presta_prix * get_presta_quantite);//Calcul montant de la presta
        $(set_presta_montant).val(total_montant);

        var num_presta = $('.prestation').length;//Get le nb de tr avec la class prestation
        var total = "0";

        if (del === 1) {
            for (var nb = 0; nb < num_presta; nb++) {//Boucle afin d'avoir le total de tout les montants
                var get_class2 = $(this).attr('class').split(' ');//Get all class of tr.prestation
                var get_class_nb2 = get_class2[2];//Get the second class (le nb)
                var get_parent_class2 = "." + get_class_nb2;//.[nb]
            }
            var get_montant_spe = $(get_parent_class2).find('.presta_montant.' + get_class_nb2).val();
            total = (parseInt(toto) + parseInt(get_montant_spe));
            $("#montant_tht").val(total);
            const tva = (total * 0.2);
            const ttc = (tva + total);
            $("#montant_tva").val(tva);
            $("#montant_ttc").val(ttc);
        }
        else {
            for (var nb = 0; nb < num_presta; nb++) {//Boucle afin d'avoir le total de tout les montants
                var get = $('.' + nb).find('.presta_montant').val();
                total = (parseInt(total) + parseInt(get));
                $("#montant_tht").val(total);
                const tva = (total * 0.2);
                const ttc = (tva + total);
                $("#montant_tva").val(tva);
                $("#montant_ttc").val(ttc);
               
            }
        }
    });


});


