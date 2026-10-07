function tSep(x){
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/**
 * Show a toast notification at the bottom of the screen.
 * @param {string} message  The message to display.
 * @param {string} type     One of: success, error, info (default: info).
 * @param {number} duration Duration in ms before auto-hide (default: 2500).
 */
function showToast(message, type, duration){
	type = type || "info";
	duration = duration || 2500;

	var container = document.getElementById("toast-container");
	if(!container){
		container = document.createElement("div");
		container.id = "toast-container";
		document.body.appendChild(container);
	}

	var icons = {
		success : "fa-check-circle",
		error   : "fa-exclamation-circle",
		info    : "fa-info-circle"
	};

	var toast = document.createElement("div");
	toast.className = "toast " + type;
	toast.innerHTML = "<i class='fa " + (icons[type] || icons.info) + "'></i><span></span>";
	toast.querySelector("span").textContent = message;
	container.appendChild(toast);

	setTimeout(function(){
		toast.classList.add("hide");
		setTimeout(function(){
			if(toast.parentNode) toast.parentNode.removeChild(toast);
		}, 300);
	}, duration);
}

/**
 * Debounce a function so it only runs after `wait` ms of inactivity.
 */
function debounce(fn, wait){
	var timeout;
	return function(){
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function(){
			fn.apply(context, args);
		}, wait);
	};
}

/**
 * Format a number with thousands separators and fixed decimals.
 */
function formatMoney(value, decimals){
	decimals = (typeof decimals === "undefined") ? 2 : decimals;
	return tSep(parseFloat(value).toFixed(decimals));
}
