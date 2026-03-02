<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
    <nav class="bg-gray-800 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h3 class="text-white text-lg font-bold">MyApp</h3>
            <div>
                <!-- links use pseudo-element with transform scaleX for left-to-right underline animation -->
                <a href="#" class="relative inline-block text-white px-3 py-2 rounded-md text-sm font-medium before:content-[''] before:absolute before:bottom-0 before:left-0 before:h-0.5 before:w-full before:bg-white before:origin-left before:transform before:scale-x-100 before:transition-transform before:duration-300">
                    Home
                    <span class="sr-only">(current)</span>
                </a>
                <a href="#" class="relative inline-block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium before:content-[''] before:absolute before:bottom-0 before:left-0 before:h-0.5 before:w-full before:bg-white before:origin-left before:transform before:scale-x-0 before:transition-transform before:duration-300 hover:before:scale-x-100">Products</a>
                <a href="#" class="relative inline-block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium before:content-[''] before:absolute before:bottom-0 before:left-0 before:h-0.5 before:w-full before:bg-white before:origin-left before:transform before:scale-x-0 before:transition-transform before:duration-300 hover:before:scale-x-100">About</a>
                <a href="#" class="relative inline-block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium before:content-[''] before:absolute before:bottom-0 before:left-0 before:h-0.5 before:w-full before:bg-white before:origin-left before:transform before:scale-x-0 before:transition-transform before:duration-300 hover:before:scale-x-100">Contact</a>
            </div>
        </div>
        
        
    </nav>
</body>
<script>
    const navlinks = document.querySelectorAll('nav a');
    // initialize: ensure first link shows underline (scale-x-100) and others are scale-x-0
    if (navlinks.length) {
        navlinks.forEach((l, i) => {
            if (i === 0) {
                l.classList.add( 'text-white', 'before:scale-x-100');
            } else {
                l.classList.add('before:scale-x-0');
            }
        });
    }

    navlinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const tgt = e.currentTarget;
            navlinks.forEach(l => {
                l.classList.remove( 'text-white', 'before:scale-x-100');
                l.classList.add('before:scale-x-0');
            });
            tgt.classList.add( 'text-white');
            tgt.classList.remove('before:scale-x-0');
            tgt.classList.add('before:scale-x-100');
        });
    });

</script>
</html>