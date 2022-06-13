<?php
function get_search_form_template()
{
	?>
	<button id="open_search_form" class="btn btn-light btn-sm">Search</button>

	<div id="search_form">
		<?php get_search_form(); ?>
	</div>

	<style>
	#search_form {
		border-radius: 5px;
		position: fixed;
		display: none;
		bottom: -25px;
		left: 0px;
		transition: 0.7s;
		-webkit-transition: 0.7s;
	}
	@media only screen and (min-width: 992px) {
		#search_form {
			left: 777px;
		}
	}
	@media only screen and (min-width: 1000px) {
		#search_form {
			left: 787px;
		}
	}
	@media only screen and (min-width: 1100px) {
		#search_form {
			left: 876px;
		}
	}
	@media only screen and (min-width: 1200px) {
		#search_form {
			left: 1016px;
		}
	}
	@media only screen and (min-width: 1300px) {
		#search_form {
			left: 1062px;
		}
	}
	@media only screen and (min-width: 1400px) {
		#search_form {
			left: 1084px;
		}
	}
	@media only screen and (min-width: 1500px) {
		#search_form {
			left: 1168px;
		}
	}
	@media only screen and (min-width: 1600px) {
		#search_form {
			left: 1174px;
		}
	}
	@media only screen and (min-width: 1700px) {
		#search_form {
			left: 1300px;
		}
	}
	</style>
	<script type="text/javascript">
		document.getElementById("open_search_form").addEventListener("click", function (e) {
			document.body.classList.toggle('search-mode');

			var frm = document.getElementById("search_form");

			if (e.target.textContent === "Search") {
				e.target.textContent = "Close";
				frm.style.display = "block";
			} else {
				e.target.textContent = "Search";
				frm.style.display = "none";
			}
		});
	</script>
	<?php
}