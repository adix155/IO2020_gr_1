using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// A data class holding the loged in users information
/// </summary>
public class LoggedInUser
{


  #region Attributes

  /// <summary>
  /// A property with a public getter but private setter
  /// </summary>
  public string Login
  {
        get; private set;

  }



  /// <summary>
  /// A singleton instance of the class
  /// </summary>
  private static LoggedInUser loggedInUser;

  /// <summary>
  /// A property with a public getter and private setter. It determines if the user
  /// has access to sensitive data like name of the recoredees.
  /// </summary>
  private bool SensitiveDataAccess = false;

  /// <summary>
  /// A property with a public getter and a private setter that determines whether any
  /// user has been logged in.
  /// </summary>
  private bool IsLoggedIn = false;

  #endregion


  #region Public methods

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesnt
  /// exist.
  /// </summary>
  /// <returns></returns>
  public static LoggedInUser LoggedInUserInstance()
  {
        if (loggedInUser == null)
        {
            loggedInUser = new LoggedInUser();
        }
        return loggedInUser;     
  }

  /// <summary>
  /// A function that changes the data of the LoggedInUser according to the passed
  /// params.
  /// </summary>
  /// <param name="login"></param>
  /// <param name="sensitiveDataAccess"></param>
  /// <param name="isLoggedIn"></param>
  /// <returns></returns>
  public void ChangeUser(bool isLoggedIn, string login="guest", bool sensitiveDataAccess = false)
  {
    throw new Exception("The method or operation is not implemented.");
  }

  #endregion


  #region Private methods

  /// <summary>
  /// A private constructor
  /// </summary>
  /// <returns></returns>
  private LoggedInUser()
  {
  }

  #endregion


}

