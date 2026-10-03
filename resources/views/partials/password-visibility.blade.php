<style>
.password-control{position:relative;width:100%}.password-control>input{padding-right:72px!important}.password-toggle{position:absolute;top:50%;right:9px;transform:translateY(-50%);padding:5px 7px;border:0;border-radius:6px;background:transparent;color:#486c53;font:inherit;font-size:12px;line-height:1.2;font-weight:600;cursor:pointer}.password-toggle:hover{background:#edf4ef}.password-toggle:focus-visible{outline:2px solid #6a916d;outline-offset:1px}
</style>
<script>
document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    const field = document.getElementById(button.getAttribute('aria-controls'));
    if (!field || button.dataset.ready) return;
    button.dataset.ready = '1';
    button.addEventListener('click', () => {
        const showing = field.type === 'password';
        field.type = showing ? 'text' : 'password';
        button.textContent = showing ? 'Hide' : 'Show';
        button.setAttribute('aria-label', `${showing ? 'Hide' : 'Show'} password`);
        button.setAttribute('aria-pressed', showing ? 'true' : 'false');
    });
});
</script>
