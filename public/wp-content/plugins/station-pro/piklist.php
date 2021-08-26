<?php
/*
 * Station Pro - Easy Web Radio in Wordpress - by marviorocha.com
 *
 *
 * Plugin Name: Station PRO
 * Plugin URI: http://marviorocha.com/stationpro
 * Tags: streaming, shoutcast, icacast, radio, live streaming, web radio, online radio, automation online, station, on ar, comunication, player, html5 player
 * Author: Marvio Rocha <marviorocha@marviorocha.com>
 * Author URI: http://marviorocha.com/
 * Version: 2.2.2
 * Description:  The Station PRO is plugin to automation web radio SHOUTcast or Icecast. With responsive and custom player for your wordpress site.
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: station-pro
 * @fs_premium_only /lib/functions.php, /premium-files/
*/

/*
  Copyright (c) 2012-2020 Piklist, LLC.
  All rights reserved.

  This software is distributed under the GNU General Public License, Version 2,
  June 1991. Copyright (C) 1989, 1991 Free Software Foundation, Inc., 51 Franklin
  St, Fifth Floor, Boston, MA 02110, USA

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

  *******************************************************************************
  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
  DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
  ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
  ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
  *******************************************************************************
*/
if (!defined('ABSPATH')) {
  exit;
}


if (function_exists('stationpro')) {
  stationpro()->set_basename(true, __FILE__);
} else {
  // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
  if (!function_exists('stationpro')) {
  }

  if (!class_exists('Piklist')) {
    include_once 'includes/class-piklist.php';
    include_once 'class/navbar.class.php';
    include_once 'shop-production.php';

    piklist::load();
  }
}
