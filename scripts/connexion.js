window.addEventListener('scroll', function()
{
    const footer = document.getElementById('footer');
    if(window.scrollY > 0)
    {
        footer.style.display = 'flex';
    }
    else
    {
        footer.style.display = 'none';
    }
});