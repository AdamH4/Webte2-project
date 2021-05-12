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
    wsHost: window.location.host,
    wsPort: 6001,
    disableStats: true,
    forceTLS: false,
    enabledTransports: ["ws", "wss"],
});
