function removeImmMessage() {
  var immTextContent = document.getElementById("messageInStoreTop").textContent;
  var d = new Date();
  d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie =
    "imm_message" + "=" + immTextContent + ";" + expires + ";path=/";
  document.getElementById("messageInStoreTop").style.display = "none";
}
