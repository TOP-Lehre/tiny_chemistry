<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Tiny chemistry plugin settings.
 *
 * @package    tiny_chemistry
 * @copyright  adapted for chemistry 2023 TOP Lehre FH OOE, Campus Hagenberg (elearning@fh-hagenberg.at), original based on Huong Nguyen <huongnv13@gmail.com> for tiny equation, 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('editortiny', new admin_category('tiny_chemistry', new lang_string('pluginname', 'tiny_chemistry')));
$settings = new admin_settingpage('tiny_chemistry_settings', new lang_string('settings', 'tiny_chemistry'));

if ($ADMIN->fulltree) {
    // Group 1.
    $name = new lang_string('librarygroup1', 'tiny_chemistry');
    $desc = new lang_string('librarygroup1_desc', 'tiny_chemistry');
    $default = '
    \ce{X+}
    \ce{X^2+}
    \ce{Y^3+}
    \ce{X^-}
    \ce{X^2-}
    \ce{X^3-}
    \ce{X2}
    \ce{X2Y}
    \ce{X2Y3}
    \ce{^{a}X}
    \ce{^{a}_{b}X}
    \ce{^{a}_{b}X^c}
    \ce{X_{(s)}}
    \ce{X_{(l)}}
    \ce{X_{(g)}}
    \ce{X_{(aq)}}
    \overset{\ce{a}}{\ce{X}}
    \underset{\ce{b}}{\ce{X}}
    \overset{\ce{a}}{\underset{\ce{b}}{\ce{X}}}
    \pm
    +
    \oplus
    \ominus
    -
    \ce{e^-}
    \ce{p^+}
    I
    II
    III
    IV
    V
    VI
    VII
    VIII
    IX
    X
';
    $setting = new admin_setting_configtextarea('tiny_chemistry/librarygroup1',
        $name,
        $desc,
        $default);
    $settings->add($setting);

    // Group 2.
    $name = new lang_string('librarygroup2', 'tiny_chemistry');
    $desc = new lang_string('librarygroup2_desc', 'tiny_chemistry');
    $default = '
    .
    :
    \circ
    {}^{\circ}C
    {}^{\circ}F
    \oplus
    \ominus
    \ce{1/2}
    \frac{[\ce{A}]}{[\ce{B}]}
    \frac{[\ce{A}][\ce{B}]}{[\ce{C}]}
    \frac{[\ce{A}][\ce{B}]}{[\ce{C}][\ce{D}]}
    {K}
    {K}_\ce{c}
    {K}_\ce{a}
    {K}_\ce{w}
    {K}_\ce{stab}
    \Delta H
    \Delta H_\ce{r}
    \Delta H_\ce{c}
    \Delta H_\ce{f}
    \Delta H_\ce{r}^\ominus
    \Delta H_\ce{c}^\ominus
    \Delta H_\ce{f}^\ominus
    \Delta G
    {T}
    \Delta S
    {E}^{\ominus}
    {A}_\ce{r}
    {M}_\ce{r}
    pH
    p{K}_{a}
    \log
    \log_{10}
    \ce{mol}
    \ce{mol^{-1}}
    \ce{ dm^3}
    \ce{dm^{-3}}
    ]\:[
    ]\quad[
';
    $setting = new admin_setting_configtextarea('tiny_chemistry/librarygroup2',
        $name,
        $desc,
        $default);
    $settings->add($setting);

    // Group 3.
    $name = new lang_string('librarygroup3', 'tiny_chemistry');
    $desc = new lang_string('librarygroup3_desc', 'tiny_chemistry');
    $default = '
    \ce{\bond{-}}
    \ce{\bond{=}}
    \ce{\bond{#}}
    \ce{\bond{~}}
    \ce{\bond{~-}}
    \ce{\bond{~=}}
    \ce{\bond{-~-}}
    \ce{\bond{...}}
    \ce{\bond{....}}
    \ce{\bond{->}}
    \ce{->[{text above}]}
    \ce{->[{text above}][{text below}]}
    \ce{->[][{text below}]}
    \ce{^}
    \ce{v}
    \upharpoonleft
    \downharpoonright
    \rightleftharpoons
';
    $setting = new admin_setting_configtextarea('tiny_chemistry/librarygroup3',
        $name,
        $desc,
        $default);
    $settings->add($setting);

    // Group 4.
    $name = new lang_string('librarygroup4', 'tiny_chemistry');
    $desc = new lang_string('librarygroup4_desc', 'tiny_chemistry');
    $default = '
    \alpha
    \beta
    \gamma
    \delta
    \epsilon
    \zeta
    \eta
    \theta
    \iota
    \kappa
    \lambda
    \mu
    \nu
    \xi
    {o}
    \pi
    \rho
    \sigma
    \tau
    \upsilon
    \phi
    \chi
    \psi
    \omega
    A
    B
    \Gamma
    \Delta
    E
    Z
    H
    \Theta
    I
    K
    \Lambda
    M
    N
    \Xi
    O
    \Pi
    P
    \Sigma
    T
    \Upsilon
    \Phi
    X
    \Psi
    \Omega
';
    $setting = new admin_setting_configtextarea('tiny_chemistry/librarygroup4',
        $name,
        $desc,
        $default);
    $settings->add($setting);
	
	// Group 5.
    $name = new lang_string('librarygroup5', 'tiny_chemistry');
    $desc = new lang_string('librarygroup5_desc', 'tiny_chemistry');
    $default = '
    {a}
    {b}
    {c}
    {d}
    {e}
    {f}
    {g}
    {h}
    {i}
    {j}
    {k}
    {l}
    {m}
    {n}
    {o}
    {p}
    {q}
    {r}
    {s}
    {t}
    {u}
    {v}
    {w}
    {x}
    {y}
    {z}
    {A}
    {B}
    {C}
    {D}
    {E}
    {F}
    {G}
    {H}
    {I}
    {J}
    {K}
    {L}
    {M}
    {N}
    {O}
    {P}
    {Q}
    {R}
    {S}
    {T}
    {U}
    {V}
    {W}
    {X}
    {Y}
    {Z}
';
    $setting = new admin_setting_configtextarea('tiny_chemistry/librarygroup5',
        $name,
        $desc,
        $default);
    $settings->add($setting);
}