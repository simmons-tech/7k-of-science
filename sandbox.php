<script>


function loopAdvance() {
	if (navigator.onLine) {
	  alert('ONLINE!');
	} else {
	  alert('Connection flaky');
	}

	setTimeout("loopAdvance()",5000);
}

loopAdvance();

</script>