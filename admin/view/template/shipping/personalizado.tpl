<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_titulo; ?></td>
            <td><input type="text" maxlength="40" name="personalizado_titulo" value="<?php echo $personalizado_titulo; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="personalizado_status">
                <?php if ($personalizado_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="personalizado_sort_order" value="<?php echo $personalizado_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
        <br />
        <table id="frete-list" class="list" colspan="6">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_nome; ?></td>
              <td class="right"><?php echo $entry_prazo; ?></td>
              <td class="right"><?php echo $entry_cost; ?></td>
              <td class="right">CEP de</td>
              <td class="right">CEP até</td>
              <td></td>
            </tr>
          </thead>
          <?php $row = 0; ?>
          <?php foreach ($personalizado_fretes as $frete) { ?>
          <tbody id="frete<?php echo $row; ?>">
            <tr>
              <td class="left"><input type="text" name="personalizado_fretes[<?php echo $row; ?>][nome]" maxlength="150" size="80" value="<?php echo $frete['nome']; ?>" /></td>
              <td class="right"><input type="number" style="width:40px;" name="personalizado_fretes[<?php echo $row; ?>][dias]" value="<?php echo $frete['dias']; ?>" /></td>
              <td class="right">R$ <input type="text" size="2" name="personalizado_fretes[<?php echo $row; ?>][valor]" value="<?php echo $frete['valor']; ?>" /></td>
              <td class="right"><input type="text" class="cep" id="cepInicial" name="personalizado_fretes[<?php echo $row; ?>][cepInicial]" value="<?php echo $frete['cepInicial']; ?>" /></td>
              <td class="right"><input type="text" class="cep" id="cepFinal" name="personalizado_fretes[<?php echo $row; ?>][cepFinal]" value="<?php echo $frete['cepFinal']; ?>"  /></td>
              <td class="left"><a onclick="$('#frete<?php echo $row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="left"><a onclick="addRow();" class="button"><?php echo $button_add; ?></a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script>
/*
  Masked Input plugin for jQuery
  Copyright (c) 2007-2013 Josh Bush (digitalbush.com)
  Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
  Version: 1.3.1
*/
(function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery); 
</script>
<script type="text/javascript">
jQuery(".cep").mask("99999-999");
</script> 
<script type="text/javascript"><!--
var row = <?php echo $row; ?>;

function addRow() {
	html  = '<tbody id="frete' + row + '">';
	html += '<tr>';
	html += '<td class="left"><input type="text" name="personalizado_fretes[' + row + '][nome]" maxlength="150" size="80" /></td>';
	html += '<td class="right"><input type="number" style="width:40px;" name="personalizado_fretes[' + row + '][dias]" value="1" /></td>';
	html += '<td class="right">R$ <input type="text" size="2" name="personalizado_fretes[' + row + '][valor]" value="0.00" /></td>';
  html += '<td class="right"><input type="text" class="cep" id="cepInicial" name="personalizado_fretes[' + row + '][cepInicial]" /></td>';
  html += '<td class="right"><input type="text" class="cep" id="cepFinal" name="personalizado_fretes[' + row + '][cepFinal]" /></td>';

	html += '<td class="left"><a onclick="$(\'#frete' + row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>';
	
	$('#frete-list > tfoot').before(html);
  jQuery(".cep").mask("99999-999");
	
	row++;
}
//--></script> 
<?php echo $footer; ?> 