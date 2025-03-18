<template>
    <svg viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg">
        <!-- Main ticket body with gradient -->
        <defs>
            <linearGradient id="ticketGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:currentColor;stop-opacity:0.1"/>
                <stop offset="100%" style="stop-color:currentColor;stop-opacity:0.3"/>
            </linearGradient>
        </defs>
        
        <!-- Background with rounded corners -->
        <rect x="5" y="5" width="150" height="30" rx="15" 
              fill="url(#ticketGradient)" stroke="currentColor" stroke-width="1.5"/>
        
        <!-- Vertical lines pattern -->
        <g stroke="currentColor" stroke-width="0.5" opacity="0.5">
            <line x1="40" y1="5" x2="40" y2="35"/>
            <line x1="60" y1="5" x2="60" y2="35"/>
            <line x1="100" y1="5" x2="100" y2="35"/>
            <line x1="120" y1="5" x2="120" y2="35"/>
        </g>
        
        <!-- Circular endpoints -->
        <circle cx="15" cy="20" r="6" fill="none" stroke="currentColor" stroke-width="1.5"/>
        <circle cx="145" cy="20" r="6" fill="none" stroke="currentColor" stroke-width="1.5"/>
        
        <!-- Center dots -->
        <circle cx="15" cy="20" r="1.5" fill="currentColor"/>
        <circle cx="145" cy="20" r="1.5" fill="currentColor"/>
        
        <!-- Main text with shadow effect -->
        <text x="80" y="19" font-family="Arial" font-weight="bold" 
              font-size="14" fill="currentColor" text-anchor="middle" 
              style="letter-spacing: 1px;">TICKET</text>
        <text x="80" y="29" font-family="Arial" font-weight="bold" 
              font-size="14" fill="currentColor" text-anchor="middle" 
              style="letter-spacing: 1px;">BODE</text>
              
        <!-- Decorative elements -->
        <path d="M30,20 L35,20 M125,20 L130,20" 
              stroke="currentColor" stroke-width="1.5"/>
              
        <!-- Small corner accents -->
        <g stroke="currentColor" stroke-width="0.75">
            <path d="M45,10 L50,10 M45,30 L50,30"/>
            <path d="M110,10 L115,10 M110,30 L115,30"/>
        </g>
    </svg>
</template>
