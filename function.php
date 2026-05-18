<?php

//On réinitialise
function reset_game() {
        $joueurX = 'X';
        $joueurO = "O";
        $_SESSION['total_mouvements'] = 0;
        $_SESSION['joueur_actuel'] = $joueurX;
        $_SESSION['gagnant'] = '';
        $_SESSION['scoreX'] = 0;
        $_SESSION['scoreO'] = 0;
        $_SESSION['grid'] = [
            'y1' => '', 'y2' => '', 'y3' => '',
            'w1' => '', 'w2' => '', 'w3' => '',
            'z1' => '', 'z2' => '', 'z3' => '',
        ];
        
        if (!isset($_SESSION['SCORE'])) {
            $_SESSION['SCORE'] = [
            'X' => 0,
            'O' => 0,
        ];
        } 
        $_SESSION['message'] = "C'est au tour de " . $_SESSION['joueur_actuel'];

}
function coup_suivant() {
        
        switch($_SESSION['joueur_actuel']) {
            case 'X':
                $_SESSION['joueur_actuel'] = 'O';
                $_SESSION['scoreX']++;
                break;
                case 'O':
                $_SESSION['joueur_actuel'] = 'X';
                $_SESSION['scoreO']++;
                break;
            }
            
           $_SESSION['message'] = "C'est au tour de " . $_SESSION['joueur_actuel'];
            
}
function verif() {
    
    // ligne horizontale 1
    if ($_SESSION['grid']['y1'] !== ''
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['y2']
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['y3']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);
    }
    //ligne horizontale 2
    elseif ($_SESSION['grid']['w1'] !== ''
    && $_SESSION['grid']['w1'] === $_SESSION['grid']['w2']
    && $_SESSION['grid']['w1'] === $_SESSION['grid']['w3']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    // ligne horizontale 3
    elseif ($_SESSION['grid']['z1'] !== ''
    && $_SESSION['grid']['z1'] === $_SESSION['grid']['z2']
    && $_SESSION['grid']['z1'] === $_SESSION['grid']['z3']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    //verticale 1
    elseif ($_SESSION['grid']['y1'] !== ''
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['w1']
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['z1']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    //verticale 2
    elseif ($_SESSION['grid']['y2'] !== ''
    && $_SESSION['grid']['y2'] === $_SESSION['grid']['w2']
    && $_SESSION['grid']['y2'] === $_SESSION['grid']['z2']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    //verticale 3
    elseif ($_SESSION['grid']['y3'] !== ''
    && $_SESSION['grid']['y3'] === $_SESSION['grid']['w3']
    && $_SESSION['grid']['y3'] === $_SESSION['grid']['z3']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    // diagonale 1
    elseif($_SESSION['grid']['y1'] !== ''
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['w2']
    && $_SESSION['grid']['y1'] === $_SESSION['grid']['z3']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
    //diagonale 2
    elseif ($_SESSION['grid']['y3'] !== ''
    && $_SESSION['grid']['y3'] === $_SESSION['grid']['w2']
    && $_SESSION['grid']['y3'] === $_SESSION['grid']['z1']) {
        coup_suivant();
        gagne($_SESSION['joueur_actuel']);

    }
}


function gagne($gagnant) {

    if ($gagnant == 'X') {
        $_SESSION['SCORE']['X']++;
        reset_game();

    }
    elseif ($gagnant == 'O') {
        $_SESSION['SCORE']['O']++;
        reset_game();

    }
}

function main() {

    // Création de la $_SESSION
    
    if (!$_SESSION) {
        reset_game();
    }



    // Détection du bouton cliqué

    foreach ($_POST as $key => $value) {


        if ($key !== 'reset' && $_SESSION['grid'][$key] === '' && $_SESSION['joueur_actuel'] == 'X') {
            $_SESSION['grid'][$key] = 'X';
            $_SESSION['total_mouvements']++;
            coup_suivant(); // gérer changement de joueur 
            verif(); // vérif victoire
            break;
            
        }


        elseif ($key !== 'reset' && $_SESSION['grid'][$key] === '' && $_SESSION['joueur_actuel'] == 'O') {
            $_SESSION['grid'][$key] = 'O';
            $_SESSION['total_mouvements']++;
            coup_suivant(); // gérer changement de joueur
            verif(); // vérif victoire
            break;
        }


        // Reset de la partie
        if (isset($_POST['reset'])) {
        reset_game();
      }
    }
  }