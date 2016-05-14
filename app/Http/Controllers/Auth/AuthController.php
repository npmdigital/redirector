<?php namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
			'username' => 'required',
            'password' => 'required',
		]);

		$credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/domains');
        }

        return redirect()
               ->back()
               ->withInput($request->only('username', 'remember'))
               ->withErrors(['username' => $this->getFailedLoginMessage()]);
    }

    /**
     * Handle logout
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('auth/login');
    }

    /**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'These credentials do not match our records.';
	}
}
