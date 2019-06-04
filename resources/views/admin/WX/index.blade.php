<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>鲜花动画特效 </title>

    <style>
        /* ================
        // Settings
        // ============= */
        /* ================
        // Love Letters
        // ============= */
        .love {
            position: relative;
            margin-bottom: 6em;
            padding-top: 4em;
            text-align: center;
        }
        @media (min-width: 600px) {
            .love {
                left: 50%;
                margin-bottom: 0;
                margin-left: -9.375em;
                padding-top: 10em;
                -webkit-transform: translate(-50%, 0);
                transform: translate(-50%, 0);
            }
        }

        .letter {
            display: inline-block;
            top: 0;
            left: 0;
            display: inline-block;
            font-size: 4vmin;
            text-shadow: 0 0 .25em red, 0 0 .35em red, 0 0 .45em transparent, 0 0 .55em transparent, 0 0 .65em transparent;
        }
        @media (min-width: 600px) {
            .letter {
                motion-offset: 0;
                motion-path: path("m0, 0 c100, -150 200, -150 300, 0");
                offset-path: path("m0, 0 c100, -150 200, -150 300, 0");
            }
        }
        .letter:nth-child(1) {
            -webkit-animation: twinkle 2.7s infinite 0.9s;
            animation: twinkle 2.7s infinite 0.9s;
            motion-offset: 5.55556%;
        }
        .letter:nth-child(2) {
            -webkit-animation: twinkle 2.7s infinite 2.1s;
            animation: twinkle 2.7s infinite 2.1s;
            motion-offset: 11.11111%;
        }
        .letter:nth-child(3) {
            -webkit-animation: twinkle 2.7s infinite 2.7s;
            animation: twinkle 2.7s infinite 2.7s;
            motion-offset: 16.66667%;
        }
        .letter:nth-child(4) {
            -webkit-animation: twinkle 2.7s infinite 1.2s;
            animation: twinkle 2.7s infinite 1.2s;
            motion-offset: 22.22222%;
        }
        .letter:nth-child(5) {
            -webkit-animation: twinkle 2.7s infinite 1.8s;
            animation: twinkle 2.7s infinite 1.8s;
            motion-offset: 27.77778%;
        }
        .letter:nth-child(6) {
            -webkit-animation: twinkle 2.7s infinite 2.25s;
            animation: twinkle 2.7s infinite 2.25s;
            motion-offset: 33.33333%;
        }
        .letter:nth-child(7) {
            -webkit-animation: twinkle 2.7s infinite 1.8s;
            animation: twinkle 2.7s infinite 1.8s;
            motion-offset: 38.88889%;
        }
        .letter:nth-child(8) {
            -webkit-animation: twinkle 2.7s infinite 2.1s;
            animation: twinkle 2.7s infinite 2.1s;
            motion-offset: 44.44444%;
        }
        .letter:nth-child(9) {
            -webkit-animation: twinkle 2.7s infinite 0.6s;
            animation: twinkle 2.7s infinite 0.6s;
            motion-offset: 50%;
        }
        .letter:nth-child(10) {
            -webkit-animation: twinkle 2.7s infinite 0.3s;
            animation: twinkle 2.7s infinite 0.3s;
            motion-offset: 55.55556%;
        }
        .letter:nth-child(11) {
            -webkit-animation: twinkle 2.7s infinite 1.5s;
            animation: twinkle 2.7s infinite 1.5s;
            motion-offset: 61.11111%;
        }
        .letter:nth-child(12) {
            -webkit-animation: twinkle 2.7s infinite 1.35s;
            animation: twinkle 2.7s infinite 1.35s;
            motion-offset: 66.66667%;
        }
        .letter:nth-child(13) {
            -webkit-animation: twinkle 2.7s infinite 0.75s;
            animation: twinkle 2.7s infinite 0.75s;
            motion-offset: 72.22222%;
        }
        .letter:nth-child(14) {
            -webkit-animation: twinkle 2.7s infinite 2.7s;
            animation: twinkle 2.7s infinite 2.7s;
            motion-offset: 77.77778%;
        }
        .letter:nth-child(15) {
            -webkit-animation: twinkle 2.7s infinite 0.6s;
            animation: twinkle 2.7s infinite 0.6s;
            motion-offset: 83.33333%;
        }
        .letter:nth-child(16) {
            -webkit-animation: twinkle 2.7s infinite 0.6s;
            animation: twinkle 2.7s infinite 0.6s;
            motion-offset: 88.88889%;
        }
        .letter:nth-child(17) {
            -webkit-animation: twinkle 2.7s infinite 0.9s;
            animation: twinkle 2.7s infinite 0.9s;
            motion-offset: 94.44444%;
        }
        .letter:nth-child(18) {
            -webkit-animation: twinkle 2.7s infinite 1.65s;
            animation: twinkle 2.7s infinite 1.65s;
            motion-offset: 100%;
        }
        .letter:empty {
            padding: 0 .2em;
        }

        @-webkit-keyframes twinkle {
            50% {
                text-shadow: 0 0 .25em red, 0 0 .35em red, 0 0 .45em red, 0 0 .55em red, 0 0 .65em red;
            }
        }

        @keyframes twinkle {
            50% {
                text-shadow: 0 0 .25em red, 0 0 .35em red, 0 0 .45em red, 0 0 .55em red, 0 0 .65em red;
            }
        }
        /* ================
        // Roses
        // ============= */
        .roses {
            position: relative;
            height: 50vmin;
            width: 100%;
            -webkit-animation: grow 10s forwards;
            animation: grow 10s forwards;
            -webkit-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        @-webkit-keyframes grow {
            100% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
        }

        @keyframes grow {
            100% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
        }
        .rose {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-perspective: 50em;
            perspective: 50em;
            -webkit-transform: translate(-50%, -50%) rotate(-25deg);
            transform: translate(-50%, -50%) rotate(-25deg);
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }
        .rose:nth-child(1) {
            z-index: 6;
            height: 5.9vmin;
            width: 5.9vmin;
        }
        .rose:nth-child(2) {
            z-index: 5;
            height: 12.35vmin;
            width: 12.35vmin;
        }
        .rose:nth-child(3) {
            z-index: 4;
            height: 14.75vmin;
            width: 14.75vmin;
        }
        .rose:nth-child(4) {
            z-index: 3;
            height: 17.65vmin;
            width: 17.65vmin;
        }
        .rose:nth-child(5) {
            z-index: 2;
            height: 24vmin;
            width: 24vmin;
        }
        .rose:nth-child(6) {
            z-index: 1;
            height: 28vmin;
            width: 28vmin;
        }
        .rose:nth-child(7) {
            z-index: 0;
            height: 31.05vmin;
            width: 31.05vmin;
        }

        .pedal {
            position: absolute;
            bottom: 50%;
            left: 50%;
            height: 100%;
            width: 100%;
            -webkit-transform-origin: center 100%;
            transform-origin: center 100%;
        }
        .pedal:before {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            content: '';
            border-radius: .35em 50% 35% 50%;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .pedal:nth-child(1) {
            -webkit-transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(1) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 2.7s;
            animation: flower-1 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(1):before {
            background: #a40000;
        }
        .rose:nth-child(1) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 2.7s;
            animation: flower-2 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(2):before {
            background: #f40000;
        }
        .rose:nth-child(1) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 2.7s;
            animation: flower-3 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(3):before {
            background: #f10000;
        }
        .rose:nth-child(1) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 2.7s;
            animation: flower-4 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(4):before {
            background: #ae0000;
        }
        .rose:nth-child(1) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 2.7s;
            animation: flower-5 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(5):before {
            background: #960000;
        }
        .rose:nth-child(1) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 2.7s;
            animation: flower-6 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(6):before {
            background: #e80000;
        }
        .rose:nth-child(1) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 2.7s;
            animation: flower-7 10s forwards 2.7s;
        }
        .rose:nth-child(1) .pedal:nth-child(7):before {
            background: #d40000;
        }
        .pedal:nth-child(2) {
            -webkit-transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(2) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 2.25s;
            animation: flower-1 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(1):before {
            background: #ac0000;
        }
        .rose:nth-child(2) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 2.25s;
            animation: flower-2 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(2):before {
            background: #e00000;
        }
        .rose:nth-child(2) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 2.25s;
            animation: flower-3 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(3):before {
            background: #950000;
        }
        .rose:nth-child(2) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 2.25s;
            animation: flower-4 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(4):before {
            background: #d50000;
        }
        .rose:nth-child(2) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 2.25s;
            animation: flower-5 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(5):before {
            background: #c40000;
        }
        .rose:nth-child(2) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 2.25s;
            animation: flower-6 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(6):before {
            background: #d90000;
        }
        .rose:nth-child(2) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 2.25s;
            animation: flower-7 10s forwards 2.25s;
        }
        .rose:nth-child(2) .pedal:nth-child(7):before {
            background: #d80000;
        }
        .pedal:nth-child(3) {
            -webkit-transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(3) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 1.8s;
            animation: flower-1 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(1):before {
            background: #9a0000;
        }
        .rose:nth-child(3) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 1.8s;
            animation: flower-2 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(2):before {
            background: #ea0000;
        }
        .rose:nth-child(3) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 1.8s;
            animation: flower-3 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(3):before {
            background: #c40000;
        }
        .rose:nth-child(3) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 1.8s;
            animation: flower-4 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(4):before {
            background: #ef0000;
        }
        .rose:nth-child(3) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 1.8s;
            animation: flower-5 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(5):before {
            background: #cd0000;
        }
        .rose:nth-child(3) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 1.8s;
            animation: flower-6 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(6):before {
            background: #a90000;
        }
        .rose:nth-child(3) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 1.8s;
            animation: flower-7 10s forwards 1.8s;
        }
        .rose:nth-child(3) .pedal:nth-child(7):before {
            background: #ad0000;
        }
        .pedal:nth-child(4) {
            -webkit-transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(4) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 1.35s;
            animation: flower-1 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(1):before {
            background: #fb0000;
        }
        .rose:nth-child(4) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 1.35s;
            animation: flower-2 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(2):before {
            background: #bf0000;
        }
        .rose:nth-child(4) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 1.35s;
            animation: flower-3 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(3):before {
            background: #f00000;
        }
        .rose:nth-child(4) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 1.35s;
            animation: flower-4 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(4):before {
            background: #b10000;
        }
        .rose:nth-child(4) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 1.35s;
            animation: flower-5 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(5):before {
            background: #e60000;
        }
        .rose:nth-child(4) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 1.35s;
            animation: flower-6 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(6):before {
            background: #d10000;
        }
        .rose:nth-child(4) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 1.35s;
            animation: flower-7 10s forwards 1.35s;
        }
        .rose:nth-child(4) .pedal:nth-child(7):before {
            background: #c40000;
        }
        .pedal:nth-child(5) {
            -webkit-transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(5) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 0.9s;
            animation: flower-1 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(1):before {
            background: #e40000;
        }
        .rose:nth-child(5) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 0.9s;
            animation: flower-2 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(2):before {
            background: #cd0000;
        }
        .rose:nth-child(5) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 0.9s;
            animation: flower-3 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(3):before {
            background: #ef0000;
        }
        .rose:nth-child(5) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 0.9s;
            animation: flower-4 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(4):before {
            background: #c20000;
        }
        .rose:nth-child(5) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 0.9s;
            animation: flower-5 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(5):before {
            background: #d20000;
        }
        .rose:nth-child(5) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 0.9s;
            animation: flower-6 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(6):before {
            background: #b20000;
        }
        .rose:nth-child(5) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 0.9s;
            animation: flower-7 10s forwards 0.9s;
        }
        .rose:nth-child(5) .pedal:nth-child(7):before {
            background: #e40000;
        }
        .pedal:nth-child(6) {
            -webkit-transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(6) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 0.45s;
            animation: flower-1 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(1):before {
            background: #d20000;
        }
        .rose:nth-child(6) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 0.45s;
            animation: flower-2 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(2):before {
            background: #ab0000;
        }
        .rose:nth-child(6) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 0.45s;
            animation: flower-3 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(3):before {
            background: #e50000;
        }
        .rose:nth-child(6) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 0.45s;
            animation: flower-4 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(4):before {
            background: #f50000;
        }
        .rose:nth-child(6) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 0.45s;
            animation: flower-5 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(5):before {
            background: #960000;
        }
        .rose:nth-child(6) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 0.45s;
            animation: flower-6 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(6):before {
            background: #a60000;
        }
        .rose:nth-child(6) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 0.45s;
            animation: flower-7 10s forwards 0.45s;
        }
        .rose:nth-child(6) .pedal:nth-child(7):before {
            background: #e80000;
        }
        .pedal:nth-child(7) {
            -webkit-transform: translate(-50%, 0) rotateZ(360deg) rotateX(-70deg) rotateY(8deg) scale(0);
            transform: translate(-50%, 0) rotateZ(360deg) rotateX(-70deg) rotateY(8deg) scale(0);
        }
        .rose:nth-child(7) .pedal:nth-child(1) {
            -webkit-animation: flower-1 10s forwards 0s;
            animation: flower-1 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(1):before {
            background: #f70000;
        }
        .rose:nth-child(7) .pedal:nth-child(2) {
            -webkit-animation: flower-2 10s forwards 0s;
            animation: flower-2 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(2):before {
            background: #dc0000;
        }
        .rose:nth-child(7) .pedal:nth-child(3) {
            -webkit-animation: flower-3 10s forwards 0s;
            animation: flower-3 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(3):before {
            background: #de0000;
        }
        .rose:nth-child(7) .pedal:nth-child(4) {
            -webkit-animation: flower-4 10s forwards 0s;
            animation: flower-4 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(4):before {
            background: #f30000;
        }
        .rose:nth-child(7) .pedal:nth-child(5) {
            -webkit-animation: flower-5 10s forwards 0s;
            animation: flower-5 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(5):before {
            background: #cd0000;
        }
        .rose:nth-child(7) .pedal:nth-child(6) {
            -webkit-animation: flower-6 10s forwards 0s;
            animation: flower-6 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(6):before {
            background: #920000;
        }
        .rose:nth-child(7) .pedal:nth-child(7) {
            -webkit-animation: flower-7 10s forwards 0s;
            animation: flower-7 10s forwards 0s;
        }
        .rose:nth-child(7) .pedal:nth-child(7):before {
            background: #ce0000;
        }

        @-webkit-keyframes flower-1 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }

        @keyframes flower-1 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(51.42857deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-2 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-2 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(102.85714deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-3 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-3 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(154.28571deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-4 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-4 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(205.71429deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-5 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-5 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(257.14286deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-6 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-6 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(308.57143deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @-webkit-keyframes flower-7 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(360deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(360deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        @keyframes flower-7 {
            100% {
                -webkit-transform: translate(-50%, 0) rotateZ(360deg) rotateX(0) rotateY(8deg) scale(1);
                transform: translate(-50%, 0) rotateZ(360deg) rotateX(0) rotateY(8deg) scale(1);
            }
        }
        /* ================
        // Bursts
        // ============= */
        .bubbles {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            pointer-events: none;
        }

        .bubble {
            position: absolute;
            z-index: 200;
            border-radius: 50%;
        }
        .bubble:nth-child(1) {
            top: 78%;
            left: 24%;
            height: 5vmin;
            width: 5vmin;
            -webkit-animation: love-burst 3s infinite 0s;
            animation: love-burst 3s infinite 0s;
            box-shadow: inset 0 0 0 2.5vmin #fff;
            -webkit-transform: translate(0, 0.95em) scale(0);
            transform: translate(0, 0.95em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(2) {
            top: 86%;
            left: 53%;
            height: 6vmin;
            width: 6vmin;
            -webkit-animation: love-burst 3s infinite 0.15s;
            animation: love-burst 3s infinite 0.15s;
            box-shadow: inset 0 0 0 3vmin #fff;
            -webkit-transform: translate(0, 0.7em) scale(0);
            transform: translate(0, 0.7em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(3) {
            top: 64%;
            left: 2%;
            height: 19vmin;
            width: 19vmin;
            -webkit-animation: love-burst 3s infinite 0.3s;
            animation: love-burst 3s infinite 0.3s;
            box-shadow: inset 0 0 0 9.5vmin #fff;
            -webkit-transform: translate(0, 0.75em) scale(0);
            transform: translate(0, 0.75em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(4) {
            top: 87%;
            left: 41%;
            height: 6vmin;
            width: 6vmin;
            -webkit-animation: love-burst 3s infinite 0.45s;
            animation: love-burst 3s infinite 0.45s;
            box-shadow: inset 0 0 0 3vmin #fff;
            -webkit-transform: translate(0, 0.7em) scale(0);
            transform: translate(0, 0.7em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(5) {
            top: 19%;
            left: 88%;
            height: 17vmin;
            width: 17vmin;
            -webkit-animation: love-burst 3s infinite 0.6s;
            animation: love-burst 3s infinite 0.6s;
            box-shadow: inset 0 0 0 8.5vmin #fff;
            -webkit-transform: translate(0, 0.1em) scale(0);
            transform: translate(0, 0.1em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(6) {
            top: 74%;
            left: 52%;
            height: 9vmin;
            width: 9vmin;
            -webkit-animation: love-burst 3s infinite 0.75s;
            animation: love-burst 3s infinite 0.75s;
            box-shadow: inset 0 0 0 4.5vmin #fff;
            -webkit-transform: translate(0, 0.85em) scale(0);
            transform: translate(0, 0.85em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(7) {
            top: 67%;
            left: 52%;
            height: 5vmin;
            width: 5vmin;
            -webkit-animation: love-burst 3s infinite 0.9s;
            animation: love-burst 3s infinite 0.9s;
            box-shadow: inset 0 0 0 2.5vmin #fff;
            -webkit-transform: translate(0, 0.1em) scale(0);
            transform: translate(0, 0.1em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(8) {
            top: 53%;
            left: 51%;
            height: 11vmin;
            width: 11vmin;
            -webkit-animation: love-burst 3s infinite 1.05s;
            animation: love-burst 3s infinite 1.05s;
            box-shadow: inset 0 0 0 5.5vmin #fff;
            -webkit-transform: translate(0, 0.7em) scale(0);
            transform: translate(0, 0.7em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(9) {
            top: 31%;
            left: 21%;
            height: 19vmin;
            width: 19vmin;
            -webkit-animation: love-burst 3s infinite 1.2s;
            animation: love-burst 3s infinite 1.2s;
            box-shadow: inset 0 0 0 9.5vmin #fff;
            -webkit-transform: translate(0, 0.65em) scale(0);
            transform: translate(0, 0.65em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(10) {
            top: 12%;
            left: 56%;
            height: 19vmin;
            width: 19vmin;
            -webkit-animation: love-burst 3s infinite 1.35s;
            animation: love-burst 3s infinite 1.35s;
            box-shadow: inset 0 0 0 9.5vmin #fff;
            -webkit-transform: translate(0, 0.6em) scale(0);
            transform: translate(0, 0.6em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(11) {
            top: 92%;
            left: 75%;
            height: 17vmin;
            width: 17vmin;
            -webkit-animation: love-burst 3s infinite 1.5s;
            animation: love-burst 3s infinite 1.5s;
            box-shadow: inset 0 0 0 8.5vmin #fff;
            -webkit-transform: translate(0, 0.35em) scale(0);
            transform: translate(0, 0.35em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(12) {
            top: 49%;
            left: 70%;
            height: 1vmin;
            width: 1vmin;
            -webkit-animation: love-burst 3s infinite 1.65s;
            animation: love-burst 3s infinite 1.65s;
            box-shadow: inset 0 0 0 0.5vmin #fff;
            -webkit-transform: translate(0, 0.45em) scale(0);
            transform: translate(0, 0.45em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(13) {
            top: 45%;
            left: 46%;
            height: 19vmin;
            width: 19vmin;
            -webkit-animation: love-burst 3s infinite 1.8s;
            animation: love-burst 3s infinite 1.8s;
            box-shadow: inset 0 0 0 9.5vmin #fff;
            -webkit-transform: translate(0, 0.25em) scale(0);
            transform: translate(0, 0.25em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(14) {
            top: 28%;
            left: 44%;
            height: 19vmin;
            width: 19vmin;
            -webkit-animation: love-burst 3s infinite 1.95s;
            animation: love-burst 3s infinite 1.95s;
            box-shadow: inset 0 0 0 9.5vmin #fff;
            -webkit-transform: translate(0, 0.5em) scale(0);
            transform: translate(0, 0.5em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(15) {
            top: 10%;
            left: 72%;
            height: 18vmin;
            width: 18vmin;
            -webkit-animation: love-burst 3s infinite 2.1s;
            animation: love-burst 3s infinite 2.1s;
            box-shadow: inset 0 0 0 9vmin #fff;
            -webkit-transform: translate(0, 0.85em) scale(0);
            transform: translate(0, 0.85em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(16) {
            top: 62%;
            left: 92%;
            height: 5vmin;
            width: 5vmin;
            -webkit-animation: love-burst 3s infinite 2.25s;
            animation: love-burst 3s infinite 2.25s;
            box-shadow: inset 0 0 0 2.5vmin #fff;
            -webkit-transform: translate(0, 0.65em) scale(0);
            transform: translate(0, 0.65em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(17) {
            top: 62%;
            left: 6%;
            height: 1vmin;
            width: 1vmin;
            -webkit-animation: love-burst 3s infinite 2.4s;
            animation: love-burst 3s infinite 2.4s;
            box-shadow: inset 0 0 0 0.5vmin #fff;
            -webkit-transform: translate(0, 0.8em) scale(0);
            transform: translate(0, 0.8em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(18) {
            top: 6%;
            left: 53%;
            height: 17vmin;
            width: 17vmin;
            -webkit-animation: love-burst 3s infinite 2.55s;
            animation: love-burst 3s infinite 2.55s;
            box-shadow: inset 0 0 0 8.5vmin #fff;
            -webkit-transform: translate(0, 1.25em) scale(0);
            transform: translate(0, 1.25em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(19) {
            top: 79%;
            left: 55%;
            height: 15vmin;
            width: 15vmin;
            -webkit-animation: love-burst 3s infinite 2.7s;
            animation: love-burst 3s infinite 2.7s;
            box-shadow: inset 0 0 0 7.5vmin #fff;
            -webkit-transform: translate(0, 0.55em) scale(0);
            transform: translate(0, 0.55em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }
        .bubble:nth-child(20) {
            top: 54%;
            left: 8%;
            height: 18vmin;
            width: 18vmin;
            -webkit-animation: love-burst 3s infinite 2.85s;
            animation: love-burst 3s infinite 2.85s;
            box-shadow: inset 0 0 0 9vmin #fff;
            -webkit-transform: translate(0, 0.8em) scale(0);
            transform: translate(0, 0.8em) scale(0);
            -webkit-transform-origin: center bottom;
            transform-origin: center bottom;
        }

        @-webkit-keyframes love-burst {
            50%,
            100% {
                box-shadow: inset 0 0 0 0 red;
                -webkit-transform: translate(0, 0) scale(1);
                transform: translate(0, 0) scale(1);
            }
        }

        @keyframes love-burst {
            50%,
            100% {
                box-shadow: inset 0 0 0 0 red;
                -webkit-transform: translate(0, 0) scale(1);
                transform: translate(0, 0) scale(1);
            }
        }
        .heart {
            fill: #fff;
            opacity: 0;
        }
        .bubble:nth-child(1) .heart {
            -webkit-animation: love 3s forwards infinite 0s;
            animation: love 3s forwards infinite 0s;
            -webkit-transform: scale(0.5) rotate(-5deg);
            transform: scale(0.5) rotate(-5deg);
        }
        .bubble:nth-child(2) .heart {
            -webkit-animation: love 3s forwards infinite 0.15s;
            animation: love 3s forwards infinite 0.15s;
            -webkit-transform: scale(0.5) rotate(15deg);
            transform: scale(0.5) rotate(15deg);
        }
        .bubble:nth-child(3) .heart {
            -webkit-animation: love 3s forwards infinite 0.3s;
            animation: love 3s forwards infinite 0.3s;
            -webkit-transform: scale(0.5) rotate(-20deg);
            transform: scale(0.5) rotate(-20deg);
        }
        .bubble:nth-child(4) .heart {
            -webkit-animation: love 3s forwards infinite 0.45s;
            animation: love 3s forwards infinite 0.45s;
            -webkit-transform: scale(0.5) rotate(16deg);
            transform: scale(0.5) rotate(16deg);
        }
        .bubble:nth-child(5) .heart {
            -webkit-animation: love 3s forwards infinite 0.6s;
            animation: love 3s forwards infinite 0.6s;
            -webkit-transform: scale(0.5) rotate(-10deg);
            transform: scale(0.5) rotate(-10deg);
        }
        .bubble:nth-child(6) .heart {
            -webkit-animation: love 3s forwards infinite 0.75s;
            animation: love 3s forwards infinite 0.75s;
            -webkit-transform: scale(0.5) rotate(23deg);
            transform: scale(0.5) rotate(23deg);
        }
        .bubble:nth-child(7) .heart {
            -webkit-animation: love 3s forwards infinite 0.9s;
            animation: love 3s forwards infinite 0.9s;
            -webkit-transform: scale(0.5) rotate(-5deg);
            transform: scale(0.5) rotate(-5deg);
        }
        .bubble:nth-child(8) .heart {
            -webkit-animation: love 3s forwards infinite 1.05s;
            animation: love 3s forwards infinite 1.05s;
            -webkit-transform: scale(0.5) rotate(8deg);
            transform: scale(0.5) rotate(8deg);
        }
        .bubble:nth-child(9) .heart {
            -webkit-animation: love 3s forwards infinite 1.2s;
            animation: love 3s forwards infinite 1.2s;
            -webkit-transform: scale(0.5) rotate(-10deg);
            transform: scale(0.5) rotate(-10deg);
        }
        .bubble:nth-child(10) .heart {
            -webkit-animation: love 3s forwards infinite 1.35s;
            animation: love 3s forwards infinite 1.35s;
            -webkit-transform: scale(0.5) rotate(49deg);
            transform: scale(0.5) rotate(49deg);
        }
        .bubble:nth-child(11) .heart {
            -webkit-animation: love 3s forwards infinite 1.5s;
            animation: love 3s forwards infinite 1.5s;
            -webkit-transform: scale(0.5) rotate(-11deg);
            transform: scale(0.5) rotate(-11deg);
        }
        .bubble:nth-child(12) .heart {
            -webkit-animation: love 3s forwards infinite 1.65s;
            animation: love 3s forwards infinite 1.65s;
            -webkit-transform: scale(0.5) rotate(37deg);
            transform: scale(0.5) rotate(37deg);
        }
        .bubble:nth-child(13) .heart {
            -webkit-animation: love 3s forwards infinite 1.8s;
            animation: love 3s forwards infinite 1.8s;
            -webkit-transform: scale(0.5) rotate(-1deg);
            transform: scale(0.5) rotate(-1deg);
        }
        .bubble:nth-child(14) .heart {
            -webkit-animation: love 3s forwards infinite 1.95s;
            animation: love 3s forwards infinite 1.95s;
            -webkit-transform: scale(0.5) rotate(40deg);
            transform: scale(0.5) rotate(40deg);
        }
        .bubble:nth-child(15) .heart {
            -webkit-animation: love 3s forwards infinite 2.1s;
            animation: love 3s forwards infinite 2.1s;
            -webkit-transform: scale(0.5) rotate(-26deg);
            transform: scale(0.5) rotate(-26deg);
        }
        .bubble:nth-child(16) .heart {
            -webkit-animation: love 3s forwards infinite 2.25s;
            animation: love 3s forwards infinite 2.25s;
            -webkit-transform: scale(0.5) rotate(22deg);
            transform: scale(0.5) rotate(22deg);
        }
        .bubble:nth-child(17) .heart {
            -webkit-animation: love 3s forwards infinite 2.4s;
            animation: love 3s forwards infinite 2.4s;
            -webkit-transform: scale(0.5) rotate(-31deg);
            transform: scale(0.5) rotate(-31deg);
        }
        .bubble:nth-child(18) .heart {
            -webkit-animation: love 3s forwards infinite 2.55s;
            animation: love 3s forwards infinite 2.55s;
            -webkit-transform: scale(0.5) rotate(10deg);
            transform: scale(0.5) rotate(10deg);
        }
        .bubble:nth-child(19) .heart {
            -webkit-animation: love 3s forwards infinite 2.7s;
            animation: love 3s forwards infinite 2.7s;
            -webkit-transform: scale(0.5) rotate(-5deg);
            transform: scale(0.5) rotate(-5deg);
        }
        .bubble:nth-child(20) .heart {
            -webkit-animation: love 3s forwards infinite 2.85s;
            animation: love 3s forwards infinite 2.85s;
            -webkit-transform: scale(0.5) rotate(10deg);
            transform: scale(0.5) rotate(10deg);
        }

        @-webkit-keyframes love {
            50% {
                fill: red;
                opacity: 1;
            }
        }

        @keyframes love {
            50% {
                fill: red;
                opacity: 1;
            }
        }
        /* ================
        // Structure
        // ============= */
        html,
        body {
            height: 100%;
        }

        html {
            overflow: hidden;
            font-family: 'Petit Formal Script';
            background: -webkit-radial-gradient(center, ellipse, #051838, #0a093b 100%);
            background: radial-gradient(ellipse at center, #051838, #0a093b 100%);
            color: #fff;
        }
    </style>
</head>
<body>
<link href="https://fonts.googleapis.com/css?family=Petit+Formal+Script" rel="stylesheet">
<div class="love"><span class="letter">I</span><span class="letter"></span><span class="letter">L</span><span class="letter">o</span><span class="letter">v</span><span class="letter">e</span><span class="letter"></span><span class="letter">Y</span><span class="letter">o</span><span class="letter">u</span><span class="letter"></span><span class="letter">G</span><span class="letter">r</span><span class="letter">a</span><span class="letter">c</span><span class="letter">e</span><span class="letter">!</span>
</div>
<div class="roses">
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
    <div class="rose">
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
        <div class="pedal"></div>
    </div>
</div>
<div class="bubbles">
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
    <div class="bubble"><svg class="heart" viewBox="0 0 32 32">
            <title>heart22</title>
            <path d="M23.6 2c-3.363 0-6.258 2.736-7.599 5.594-1.342-2.858-4.237-5.594-7.601-5.594-4.637 0-8.4 3.764-8.4 8.401 0 9.433 9.516 11.906 16.001 21.232 6.13-9.268 15.999-12.1 15.999-21.232 0-4.637-3.763-8.401-8.4-8.401z"></path>
        </svg>
    </div>
</div>


</body>
</html>

