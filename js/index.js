

function goto_proverb(id) {
//     const req = {
//         "action": "goto_proverb",
//         "id": id
//     };

//     const req_json = JSON.stringify(req);

//     const xhttp = new XMLHttpRequest();
//     xhttp.onload = ()=>{
//         const resp_json = JSON.parse(this.responseText);
//         alert(resp_json);
//     }
//     xhttp.open("POST", "proverb_be_db.php");
//     xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
// xhttp.send(`proverb=${req_json}`);
}

function suggestions(id) {
    const head_id = id == 2 ? "feedback" : "suggest";
    const body_id = id == 2 ? "feedback_div" : "suggest_div";
    const hhead_id = id == 1 ? "feedback" : "suggest";
    const hbody_id = id == 1 ? "feedback_div" : "suggest_div";

    head = document.getElementById(head_id);
    body = document.getElementById(body_id);

    hhead = document.getElementById(hhead_id);
    hbody = document.getElementById(hbody_id);

    head.classList.add("s_tab_hidden");
    body.classList.add("s_tab_hidden");

    hhead.classList.remove("s_tab_hidden");
    hbody.classList.remove("s_tab_hidden");

    console.log(hhead.classList);
}
