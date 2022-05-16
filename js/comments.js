function reply (no) {
  var subjectId = document.getElementById("secret_comment" + no).value;
  var user_rep = document.getElementById("secret_username" + no).value;
  document.getElementById("comment_id").value = subjectId;
  document.getElementById("commentbox").placeholder = "Membalas komentar @" + user_rep + " : ";
  //console.log("check");
  document.getElementById("commentbox").focus();
}
function cancel () {
  document.getElementById("commentbox").placeholder = "Ketikkan Sesuatu...";
  document.getElementById("commentbox").focus();
  document.getElementById("comment_id").value = "";
}