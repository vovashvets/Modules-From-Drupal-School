//Shows current textarea length
document.getElementById('limited-textarea').onkeyup = function (){
  document.getElementById('symbol-count').innerHTML = this.value.length
};
// Shows textarea maxLength
window.onload = function (){
  let maxLength = document.getElementById("limited-textarea").maxLength
  document.getElementById("symbol-limit").innerHTML = "/" + maxLength
}

// Drupal JS API
//
// (function ($, Drupal) {
//   Drupal.behaviors.textareaLimitedBehaviour = {
//     attach: function (context) {
//       $('.limited-textarea', context).once('textareaLimitedBehaviour').each(function () {
//         var widget = $(this);
//         var textarea = $(this).find('textarea.limited-textarea');
//         textarea.keyup(function() {
//           var characterCount = textarea.val().length;
//           var current = widget.find('.symbol-count');
//           current.text(characterCount);
//         });
//       });
//     }
//   };
// })(jQuery, Drupal);
