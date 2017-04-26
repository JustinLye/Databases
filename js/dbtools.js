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

function getEntreeTable(callBackFunct, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "../php/getEntreeTable.php", async);
	x.send();
}

function getLocationTable(callBackFunct, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "../php/getLocationTable.php", async);
	x.send();
}
function getLocEntreeSummaryTable(callBackFunct, elemID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			elemID === undefined ? callBackFunct(this) : callBackFunct(this, elemID);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("GET", "../php/locEntreeSummaryTable.php",async);
	x.send();
}

function getTableDescription(callBackFunct, tableName, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "../php/describeTable.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("table_name=" + tableName);
}

function getRestaurantMinLocationTable(callBackFunct, minval) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "../php/getRestaurantMinLocationTable.php?minval="+minval);
	x.send();
}

function getRestIDList_HasLocs(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "../php/getRestIDList_HasLocs.php",false);
	x.send();
}

function getLocIDList_RestIDOnly(callBackFunct, restID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "../php/getLocIDList_RestIDOnly.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("restID="+restID);
}

function createEntreeView(callBackFunct, locID, async) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	if (async === 'undefined') {
		async = true;
	}
	x.open("POST", "../php/createEntreeView.php", async);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.send("locID=" + locID);
}

function getTables(callBackFunct) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			callBackFunct(this);
		}
	}
	x.open("GET", "../php/getTables.php");
	x.send();
}