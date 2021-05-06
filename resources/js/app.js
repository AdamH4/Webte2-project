require("./bootstrap");
require("../../node_modules/sweetalert");
// require('painterro');

//-----------------------Imports----------------------------------------------------------
import Landing from "./Landing";
import Painterro from "painterro";
import * as MathLive from "mathlive";
import Echo from "laravel-echo";

//---------------_Class instances ---------------------------------------------------------
window.pageInit = new Landing();
window.Painterro = Painterro;
window.MathLive = MathLive;

//------------------------ Websockets ------------------------------------------------------
window.Pusher = require("pusher-js");
window.Echo = new Echo({
    broadcaster: "pusher",
    key: "059867058",
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

//Test
let aisID = 9210356;
let examCode = 6345799445125;
window.Echo.private(`Exam.${aisID}.${examCode}`).listen(".Exam", (e) => {
    console.log(e);
});
