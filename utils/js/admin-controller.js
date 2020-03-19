function closeMessages(delay) {
    if (!delay){
        $(".alert-pummax").alert('close');
    }else{
        $(".alert-pummax").delay(delay).slideUp(200, function() {
            $(this).alert('close');
        });
    }
}

function applyMasks() {
    $('.date').mask('00/00/0000', {placeholder: "__/__/____"});
    $('.time').mask('00:00:00');
    $('.dateTime').mask('00/00/0000 00:00', {placeholder: "__/__/____ __:__"});
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money-limit').mask('000.000.000.000.000,00', {reverse: true});
    $('.money').mask("#.##0,00", {reverse: true});
    $('.ip').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
}