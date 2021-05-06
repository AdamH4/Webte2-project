require("./bootstrap");
require("../../node_modules/sweetalert");
// require('painterro');

//-----------------------Imports----------------------------------------------------------
import Landing from "./Landing";
import Painterro from "painterro";
import * as MathLive from "mathlive";

//---------------_Class instances ---------------------------------------------------------
window.pageInit = new Landing();
window.Painterro = Painterro;
window.MathLive = MathLive;
