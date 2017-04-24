function userTypesSelectList(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	};
	x.open("POST", "../php/reqrouter.php", false);
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
    x.open("POST", "../php/reqrouter.php", false);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=6");
    console.log("request sent");
}

function locationSelectList(callBackFunct, name) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "../php/reqrouter.php", false);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("task=1&name="+name);
}

function setRestId(async) {
    if (async === 'undefined') {
        async = false;
    } else {
        async = true;
    }
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    x.open("GET", "../php/reqrouter.php?task=5", async);
    x.send();
};

function addEntree(callBackFunct, name, desc, price, locid) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    };
    x.open("POST", "../php/add_entree.php", true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("name=" + name + "&description=" + desc + "&price=" + price + "&locid=" + locid);
}

//sends request to signup.php to insert a new user into the database
function signUp(callBackFunct, name, email, type, password, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "../php/signup.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("name=" + name + "&email=" + email + "&type=" + type + "&password=" + password);
}

//login user, sets various cookies relevant to valid user
function login(callBackFunct, username, password, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "../php/userlogin.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send("username=" + username + "&password=" + password);
}

//sends request for formated user table
function getUserTable(callBackFunct, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("POST", "../php/get_user_table.php", async);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send();
}

function getUserSummaryTable(callBackFunct, async) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callBackFunct(this);
        }
    }
    if (async === 'undefined') {
        async = true;
    }
    x.open("GET", "../php/userSummaryTable.php", async);
    x.send();

}