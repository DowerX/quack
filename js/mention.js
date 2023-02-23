function replaceMentions(text) {
    const patterns = [
        // @user
        { regex: /@([\wöüóőúéáűÖÜŐÚÉÁŰ]+)/,
          replace: '<a href="/php/api/redirect-username.php?username=$1" class="mention">@$1</a>'
        },
        // #postid
        { regex: /#([0-9]+)/,
          replace: '<a href="/php/post.php?id=$1" class="mention">#$1</a>'
        },
        // URL
        { regex: /(https|http):\/\/([\wöüóőúéáűÖÜÓŐÚÉÁŰ\.]+)([\wöüóőúéáűÖÜÓŐÚÉÁŰ\/\.\?\=\#\&\%\-\;]+)?/,
          replace: (match, g1, g2, g3) => {
            if (g3) {
                return `<a href="${match}" class="mention">${g2}/...${g3.slice(-Math.min(5, g3.length-1))}</a>`;
            } else {
                return `<a href="${match}" class="mention">${g2}</a>`;
            }
        }},
    ];
    patterns.forEach((p) => {
        text = text.replace(p.regex, p.replace);
    });
    return text;
}

document.querySelectorAll(".posts p").forEach((e) => {
    e.innerHTML = replaceMentions(e.innerHTML);
});