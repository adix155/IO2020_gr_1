using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// A screen that allows to log in to the app.
/// </summary>
public class LoginScreen
{

  #region Attributes

  /// <summary>
  /// A singleton instance of the class.
  /// </summary>
  private static LoginScreen loginScreen = null;

  #endregion


  #region Public methods

  /// <summary>
  /// Redraws all elements of the GUI updating all the elements with the proper
  /// contents
  /// </summary>
  /// <returns></returns>
  public void RefreshScreen()
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesnt
  /// exist.
  /// </summary>
  /// <returns>LoginScreen</returns>
  public static LoginScreen LoginScreenInstance()
  {
         if (loginScreen == null)
         {
              loginScreen = new LoginScreen();
         }
         return loginScreen;     
  }

  #endregion


  #region Private methods

  /// <summary>
  /// A private constructor.
  /// </summary>
  /// <returns></returns>
  private LoginScreen()
  {
  }

  #endregion


}

