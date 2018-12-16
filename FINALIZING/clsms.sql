USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [int] NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Usage_Stat_Employee] [int] NOT NULL,
	[Usage_Stat_Student] [int] NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Category_Serials_Program]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category_Serials_Program](
	[CategoryID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[ProgramID] [int] NOT NULL,
	[NumberofItemsReceived_Prog] [int] NOT NULL,
	[Usage_Stat_Employee_Prog] [int] NULL,
	[Usage_Stat_Student_Prog] [int] NULL,
 CONSTRAINT [PK_Category_Serials_Program] PRIMARY KEY CLUSTERED 
(
	[CategoryID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[Receive_Date] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery_Subs]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery_Subs](
	[DS_ID] [int] IDENTITY(1,1) NOT NULL,
	[DeliveryID] [int] NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Delivery_Subs] PRIMARY KEY CLUSTERED 
(
	[DS_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [int] IDENTITY(1,1) NOT NULL,
	[Department_Code] [varchar](50) NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distributor](
	[DistributorID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorName] [varchar](50) NOT NULL,
	[NameOfIncharge] [varchar](50) NOT NULL,
	[ContactNumber] [varchar](25) NOT NULL,
	[Email] [varchar](50) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Organization]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Organization](
	[OrganizationID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [int] NOT NULL,
	[Organization_Code] [varchar](50) NOT NULL,
	[Remove_org] [varchar](10) NULL,
	[Remove_Remarks_org] [varchar](50) NULL,
 CONSTRAINT [PK_Organization] PRIMARY KEY CLUSTERED 
(
	[OrganizationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Program]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Program](
	[ProgramID] [int] IDENTITY(1,1) NOT NULL,
	[OrganizationID] [int] NOT NULL,
	[Program_Code] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Program] PRIMARY KEY CLUSTERED 
(
	[ProgramID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [date] NOT NULL,
	[DateReceiveNotif_Receive] [date] NULL,
	[ControlNumber] [varchar](50) NULL,
	[Admin_Seen] [varchar](7) NULL,
	[Staff_Seen] [varchar](7) NULL,
	[Staff_Comment] [varchar](100) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial_Program]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial_Program](
	[ReceiveSerialID_Program] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[ProgramID] [int] NOT NULL,
	[DateReceiveNotif_Give_Prog] [date] NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
	[DateReceiveNotif_Receive_Prog] [date] NULL,
	[Status_Prog] [varchar](50) NOT NULL,
	[ControlNumber_Prog] [varchar](50) NULL,
	[Staff_Comment_Prog] [varchar](100) NULL,
 CONSTRAINT [PK_ReceiveSerial_Program] PRIMARY KEY CLUSTERED 
(
	[ReceiveSerialID_Program] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](30) NULL,
	[SerialName] [varchar](50) NOT NULL,
	[Origin] [varchar](20) NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Cost] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[Archive] [varchar](50) NULL,
	[IDD_Phase] [varchar](10) NULL,
	[InitialDeliveryDate] [date] NULL,
	[Subscription_Date] [date] NULL,
	[Subscription_End_Date] [date] NULL,
	[Frequency] [int] NOT NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 13/12/2018 5:30:02 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[User](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[FirstName] [varchar](50) NOT NULL,
	[LastName] [varchar](50) NOT NULL,
	[Avatar] [varchar](50) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
	[DepartmentID] [int] NULL,
	[Remove] [varchar](10) NULL,
	[Remove_Remarks] [varchar](50) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Department] ON 

INSERT [dbo].[Department] ([DepartmentID], [Department_Code], [Remove], [Remove_Remarks]) VALUES (3, N'College', NULL, NULL)
INSERT [dbo].[Department] ([DepartmentID], [Department_Code], [Remove], [Remove_Remarks]) VALUES (4, N'JHS', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Department] OFF
SET IDENTITY_INSERT [dbo].[Organization] ON 

INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID], [Organization_Code], [Remove_org], [Remove_Remarks_org]) VALUES (3, 3, N'SEAFA', NULL, NULL)
INSERT [dbo].[Organization] ([OrganizationID], [DepartmentID], [Organization_Code], [Remove_org], [Remove_Remarks_org]) VALUES (4, 3, N'SICS', NULL, NULL)
SET IDENTITY_INSERT [dbo].[Organization] OFF
SET IDENTITY_INSERT [dbo].[Program] ON 

INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (1, 3, N'BSCPE')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (2, 3, N'BSCE')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (3, 3, N'BSECE')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (4, 3, N'BSEE')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (5, 4, N'BSIT')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (6, 4, N'BLIS')
INSERT [dbo].[Program] ([ProgramID], [OrganizationID], [Program_Code]) VALUES (7, 4, N'BSCS')
SET IDENTITY_INSERT [dbo].[Program] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (179, N'NewAcc', N'7815696ecbf1c96e6894b779456d330e', N'New', N'Account', N'ELEM_christaa.jpg', N'NA@gmail.com', N'Staff', NULL, NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (182, N'akumao', N'21232f297a57a5a743894a0e4a801fc3', N'Aku', N'Mao', N'COLLEGE_609282.jpg', N'akumao@gmail.com', N'Admin', NULL, NULL, NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (183, N'dsadas', N'c91c03ea6c46a86cbc019be3d71d0a1a', N'dsadas', N'dsadsa', N'asd.png', N'asd@gmail.com', N'Admin', NULL, N'Removed', N'kick out
')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (184, N'dsaasd', N'7815696ecbf1c96e6894b779456d330e', N'dsadas', N'dsa', N'new_christaa.jpg', N'NA@gmail.com', N'Staff', NULL, N'Removed', N'quitted')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID], [Remove], [Remove_Remarks]) VALUES (185, N'col', N'5f039b4ef0058a1d652f13d612375a5b', N'Coll', N'c', N'College_asd.png', N'col@gmail.com', N'Staff', NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Department]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Subscription]
GO
ALTER TABLE [dbo].[Category_Serials_Program]  WITH CHECK ADD  CONSTRAINT [FK_Category_Serials_Program_Program] FOREIGN KEY([ProgramID])
REFERENCES [dbo].[Program] ([ProgramID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Category_Serials_Program] CHECK CONSTRAINT [FK_Category_Serials_Program_Program]
GO
ALTER TABLE [dbo].[Category_Serials_Program]  WITH CHECK ADD  CONSTRAINT [FK_Category_Serials_Program_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Category_Serials_Program] CHECK CONSTRAINT [FK_Category_Serials_Program_Subscription]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Delivery] FOREIGN KEY([DeliveryID])
REFERENCES [dbo].[Delivery] ([DeliveryID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Delivery]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Subscription]
GO
ALTER TABLE [dbo].[Organization]  WITH CHECK ADD  CONSTRAINT [FK_Organization_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Organization] CHECK CONSTRAINT [FK_Organization_Department]
GO
ALTER TABLE [dbo].[Program]  WITH CHECK ADD  CONSTRAINT [FK_Program_Organization] FOREIGN KEY([OrganizationID])
REFERENCES [dbo].[Organization] ([OrganizationID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Program] CHECK CONSTRAINT [FK_Program_Organization]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Department]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Serial]
GO
ALTER TABLE [dbo].[ReceiveSerial_Program]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Program_Program] FOREIGN KEY([ProgramID])
REFERENCES [dbo].[Program] ([ProgramID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial_Program] CHECK CONSTRAINT [FK_ReceiveSerial_Program_Program]
GO
ALTER TABLE [dbo].[ReceiveSerial_Program]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Program_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial_Program] CHECK CONSTRAINT [FK_ReceiveSerial_Program_Serial]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
ALTER TABLE [dbo].[User]  WITH CHECK ADD  CONSTRAINT [FK_User_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE SET DEFAULT
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
