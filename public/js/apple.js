AppleID.auth.init({
    clientId: 'com.thetourlab.webapp',
    scope: 'name email',
    redirectURI: window.location.origin,
    state: Date.now().toString(),
    usePopup: true
});


function signInWithApple() {
    AppleID.auth.signIn().then(response => {
        console.log(response);
        const { name = {}, email } = response?.user || {};
        const { id_token } = response?.authorization || {};
        const { firstName, lastName } = name;
        
        // if(!firstName || !lastName) {
        //     alert("이름은 찾을 수 없습니다. 다시 시도해주세요.");
        //     return;
        // }        

        document.getElementById("sns_key").value = id_token;
        document.getElementById("user_name").value = name;
        document.getElementById("userEmail").value = email;
        document.getElementById("gubun").value = 'apple';
        var form = document.loginForm;
        form.action = "/member/apple_login";
        form.submit();

    }).catch(error => {
        console.error('Error signing in with Apple:', error);
    });
}