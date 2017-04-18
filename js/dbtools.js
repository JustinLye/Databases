function userTypesSelectList(callBackFunct) {
	var x = new XMLHttpRequest();
	var str = "<p>test</p>";
	x.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	};
	x.open("POST", "../php/reqrouter.php", true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("task=3");
};

function restaurantSelectList(callBackFunct) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "../php/reqrouter.php", true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=6");
}

function locationSelectList(callBackFunct, name) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "../php/reqrouter.php", true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=1&name="+name);
}

function setRestId() {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    x.open("GET", "../php/reqrouter.php?task=5", true);
    x.send();
};

function addEntree(callBackFunct, name, desc, price, locaddr, locname) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "../php/add_entree.php", true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("name=" + name + "&description=" + desc + "&price=" + price + "&locaddr=" + locaddr + "&locname=" + locname);


}
